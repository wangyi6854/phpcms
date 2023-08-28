<?php
function my_autoloader( $class )
{
    if ( file_exists( ROOT . "/module/class/$class.php" ) )
    {
        include ROOT . "/module/class/$class.php";
    }
}

function error_handler( $errno, $errstr, $errfile, $errline )
{
	global $config, $output, $return_to;

	$date = date('Y-m-d H:i:s');

	$errortype = array (
				E_ERROR              => 'Error',
				E_WARNING            => 'Warning',
				E_PARSE              => 'Parsing Error',
				E_NOTICE             => 'Notice',
				E_CORE_ERROR         => 'Core Error',
				E_CORE_WARNING       => 'Core Warning',
				E_COMPILE_ERROR      => 'Compile Error',
				E_COMPILE_WARNING    => 'Compile Warning',
				E_USER_ERROR         => 'User Error',
				E_USER_WARNING       => 'User Warning',
				E_USER_NOTICE        => 'User Notice',
				E_STRICT             => 'Runtime Notice',
				E_RECOVERABLE_ERROR  => 'Catchable Fatal Error',
				);
	$user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

	$error = array(
		'error_type'	=> $errortype[$errno],
		'error_message'	=> $errstr,
		'error_file'	=> $errfile,
		'error_line'	=> $errline,
	);
	debug( array( 'error' => $error ) );
	//file_put_contents( $config['error_file'], $date . ": In file $errfile on line $errline: $errstr" . PHP_EOL, FILE_APPEND );


	if ( $errno == E_USER_ERROR )
	{
        global $tpl;
		include ROOT . "/tpl/$tpl/msg.php";
		ternimate();
	}

	return false;
}

function exception_handler( $e )
{
	global $format, $tpl;

	if ( $format == 'json' )
	{
		echo json_encode( array( 'return' => $e->getCode(), 'message' => $e->getMessage(), 'data' => null ) );
		exit();
	}

	$msg = $e->getMessage();
	switch ( $e->getCode() )
	{
		case E_USER_ERROR:
			$msg_tpl = ROOT . "/tpl/$tpl/msg.php";
			if ( defined( "MESSAGE_TPL" ) )
			{
				include MESSAGE_TPL;
			}
			elseif ( is_readable( $msg_tpl ) )
			{
				include $msg_tpl;
			}
			else
			{
				exit( $msg );
			}
			break;
		default:
			debug( $msg, 'exception' );
			break;
	}
}

function shutdown()
{
	global $direct_output;

	if ( $direct_output )
	{
		return;
	}

	$output = ob_get_clean();

	if ( defined( 'DEBUG' ) )
	{
		add_debug_info( $output );
	}

	//ob_start('ob_gzhandler');

    ob_start();
	send_content_type_header();
	echo $output;

}

function debug( $data, $key = null )
{
	global $debug;
	if ( $key )
	{
		if ( isset ( $debug[ $key ] ) )
		{
			$debug[ $key ][] = $data;
		}
		else
		{
			$debug[ $key ][] = $data;
		}
	}
	else
	{
		$debug[] = $data;
	}
}

function get_debug_contents()
{
	global $debug;

	$debug['total_process_time'] = timediff( $GLOBALS['page_start_time'] ) . 'ns';

	return var_export( $debug, true );
}

function add_debug_info( &$output )
{
	global $format, $debug;

	$debug_str = get_debug_contents();

	if ( $format == 'json' )
	{
		if ( $json = json_decode( $output, true ) )
		{
			$json[ 'debug' ] = $debug;
		}
		else
		{
			$json[ 'debug' ] = $debug;
			$json[ 'output' ] = $output;
		}
		$output = json_encode( $json, JSON_UNESCAPED_UNICODE );
	}
	elseif ( $format == 'wml' )
	{
		$debug_str = '<pre>' . PHP_EOL . htmlspecialchars( $debug_str ) . PHP_EOL . '</pre>' . PHP_EOL;
		$output = preg_replace( '/<\/card>\s*<\/wml>/i', "$debug_str\\0", $output );
	}
	else
	{
		$debug_str = '<div style="white-space: pre; font-family: monospace; text-align: left;">' . PHP_EOL . htmlspecialchars( $debug_str ) . PHP_EOL . '</div>' . PHP_EOL;
		$output = preg_replace(
            '#id="debug-message"><#i',
            "id=\"debug-message\">$debug_str<",
            $output
        );
	}
}

function check_module( $module )
{
	if ( preg_match( '/[^\.a-z\d_]/', $module ) )
	{
		throw new Exception( "can't use this module name.", E_USER_ERROR );
	}

	if ( !is_file( ROOT . "/module/" . $module . '.php' ) )
	{
		throw new Exception( "unsupported module.", E_USER_ERROR );
	}

    if ( !defined( 'ADMIN' ) && 0 === strpos( $module, 'admin' ) )
    {
        throw new Exception( "unauthorized module.", E_USER_ERROR );
    }
}

function check_tpl( $tpl )
{
	if ( preg_match( '/[^\.a-z\d_]/', $tpl ) )
	{
		throw new Exception( "can't use this template name.", E_USER_ERROR );
	}

	if ( !is_file( ROOT . "/tpl/" . $tpl . '.php' ) )
	{
		throw new Exception( "unsupported template.", E_USER_ERROR );
	}
}

function init_env()
{
	$GLOBALS[ 'vars' ] = array_merge( $_GET, $_POST, $_COOKIE );
	if ( defined( 'SESSION' ) )
	{
		$GLOBALS[ 'vars' ] = array_merge( $GLOBALS[ 'vars' ], $_SESSION );
	}

	global $config;
	$var_list = $config['var_list'];

	foreach ( $var_list as $v )
	{
		if ( isset( $GLOBALS[ 'vars' ][ $v[0] ] ) )
		{
			$GLOBALS[ $v[0] ] = get_env_var( $v[0], $v[1] );
		}
		else
		{
			$GLOBALS[ $v[0] ] = $v[2];
		}
	}

	unset( $GLOBALS[ 'vars' ] );
}

function get_env_var( $key, $type )
{
	return type_cast( $GLOBALS[ 'vars' ][ $key ], $type );
}

function type_cast( $data, $type )
{
	switch( $type )
	{
		case 'a':
			return ( array ) $data;
		case 'i':
			return ( int ) $data;
		case 'o':
			return ( object ) $data;
		case 'f':
			return ( float ) $data;
		case 'b':
			if ( strtolower( $data ) == 'true' )
			{
				return true;
			}

			if ( strtolower( $data ) == 'false' )
			{
				return false;
			}

			return ( bool ) $data;
		case 'B':					// convert to binary. (php 6)
			return ( binary ) $data;
		case 's':
		default:
			return ( string ) $data;
	}
}

function send_content_type_header()
{
	if ( strpos( PHP_SAPI, 'cli' ) !== false )
	{
		return;
	}

	global $format, $config;

	if ( $format == 'json' )
	{
		header( 'Content-Type: application/json;charset=' . $config[ 'charset' ] );
	}
	else
	{
		header( 'Content-Type: text/html;charset=' . $config[ 'charset' ] );
	}
}

function htmlspc( $str )
{
	return htmlspecialchars( $str, ENT_COMPAT, $GLOBALS[ 'config' ][ 'charset' ] );
}

function parse_coordinate_from_gis( $str )
{
	$array = preg_split( '#[,\(\) ]#', $str );

	if ( count( $array ) > 2 )
	{
		return [ 'longitude' => (float) $array[ 1 ], 'latitude' => (float) $array[ 2 ] ];
	}
	else
	{
		return [ 'longitude' => 0, 'latitude' => 0 ];
	}
}

function show_message( $message = '', $return_to = '' )
{
    global $page_title, $extra_header;

	if ( defined( 'ADMIN' ) )
	{
		include ROOT . '/tpl/admin.message.php';
	}
	else
	{
		include ROOT . '/tpl/message.php';
	}
	exit();
}

function page_string( $page, $totalrecords, $pagesize = 20, $no_last_page = false, $page_group_size = 6 )
{
	$request_uri = $_SERVER['REQUEST_URI'];
	debug( $request_uri );
	$page_string = '';
	$totalpages = ceil( $totalrecords / $pagesize ) ? ceil( $totalrecords / $pagesize ) : 1;
	$totalpages = $no_last_page ? 99 : $totalpages;
	$page = $page < 1 || $page > $totalpages ? 1 : intval( $page );

	if ( $totalpages == 1 )
	{
		return '';
	}

	$first = $page != 1 ? 1 : 0 ;
	$priv  = ( $page > 1 ) ? $page - 1 : 0;
	$next  = ( $page < $totalpages ) ? $page + 1 : 0;
	//$next  = $no_last_page ? ( $totalrecords == $pagesize ? $next : 0 ) : $next;
	$last  = $page < $totalpages ? $totalpages : 0;
	$last  = $no_last_page ? 0 : $last;

	if ( $first )
	{
		$first_url = url_query_add_arg( $request_uri, 'page', $first );
		$page_string .= "<a href=\"$first_url\">第一页</a>\n";
	}

	if ( $priv )
	{
		$priv_url = url_query_add_arg( $request_uri, 'page', $priv );
		$page_string .= "<a href=\"$priv_url\">上一页</a>\n";
	}

	if ( !$no_last_page )
	{
		$start = $page - $page_group_size / 2 >= 1 ? $page - intval( $page_group_size / 2 ) : 1;
		$end = $start + $page_group_size < $totalpages ? $start + $page_group_size : $totalpages;
		for ( $i = $start; $i <= $end; ++$i )
		{
			if ( $i == $page )
			{
				$page_string .= "<span>$i</span>\n";
			}
			else
			{
				$foo = url_query_add_arg( $request_uri, 'page', $i );
				$page_string .= "<a href=\"$foo\">$i</a>\n";
			}
		}
	}

	if ( $next )
	{
		$next_url = url_query_add_arg( $request_uri, 'page', $next );
		$page_string .= "<a href=\"$next_url\">下一页</a>\n";
	}

	if ( $last )
	{
		$last_url = url_query_add_arg( $request_uri, 'page', $last );
		$page_string .= "<a href=\"$last_url\">最后一页</a>\n";
	}

	return $page_string;
}

function url_query_add_arg( $url, $arg, $value = '', $arg_sep = '&amp;' )
{
	if ( function_exists( 'http_build_url' ) )
	{
		return http_build_url( $url, [
				'query' => "$arg=$value"
			],
			HTTP_URL_REPLACE | HTTP_URL_JOIN_PATH | HTTP_URL_JOIN_QUERY
		);
	}
	else
	{
		$comp = "$arg=" . urlencode( $value );
		@list( $s, $q ) = explode( '?', $url, 2 );

		if ( $q )
		{
			$q = str_replace( '&amp;', '&', $q );
			$q = preg_replace( "/(^|&)$arg=[^&#]+/", "$1$comp", $q, -1, $c );
			if ( $arg_sep == '&amp;' )
			{
				$q = str_replace( '&', $arg_sep, $q );
			}
			if ( !$c )
			{
				$parts = explode( '#', $q, 2 );
				if ( count( $parts ) > 1 )
				{
					list ( $t, $f ) = $parts;
				}
				else
				{
					$t = $parts[ 0 ];
					$f = '';
				}

				$q = $t . $arg_sep . $comp;
				if ( $f )
				{
					$q .= '#' . $f;
				}
			}
		}
		else
		{
			@list( $t, $f ) = explode( '#', $url, 2 );
			if ( $f )
			{
				$q = $comp . '#' . $f;
			}
			else
			{
				$q = $comp;
			}
		}

		return $s . '?' . $q;
	}
}

function html_select( $name, $text, $values, $selected = '' )
{
	$return = '<select name="' . htmlspecialchars( $name ) . '">';

	foreach ( $values as $k => $v )
	{
		$return .= '<option';
		$return .= ' value="' . htmlspecialchars( $v ) . '"';

		if ( $v == $selected )
		{
			$return .= ' selected="selected"';
		}

		$return .= '>';
		$return .= htmlspecialchars( $text[ $k ] );
		$return .= '</option>';
	}

	$return .= '</select>';
}

function html_checkbox( $name, $text, $values, $selected = [] )
{
	$return = '';

	foreach ( $values as $k => $v )
	{
		$return .= "<label>";

		$return .= "<input type=\"checkbox\" name=\"$name\" value=\"$v\"";

		if ( in_array( $v, $selected ) )
		{
			$return .= ' checked="checked"';
		}

		$return .= '>';

		$return .= $text[ $k ];

		$return .= "</label>";
	}

	return $return;
}

function html_radiobox( $name, $text, $values, $selected = '' )
{
	$return = '';

	foreach ( $values as $k => $v )
	{
		$return .= "<label>";

		$return .= "<input type=\"radio\" name=\"$name\" value=\"$v\"";

		if ( $v == $selected )
		{
			$return .= ' checked="checked"';
		}

		$return .= '>';

		$return .= $text[ $k ];

		$return .= "</label>";
	}

	return $return;
}

function gen_password( $length = 10 )
{
	return substr( md5(rand()), 0, $length );
}

function timediff( $start, $end = null )
{
	$end = $end ?: microtime(true);
	return round( ( $end - $start ) * 1000, 2 );
}

function str_startswith( $haystack, $needle )
{
    return substr_compare( $haystack, $needle, 0, strlen( $needle ) ) === 0;
}

function str_endswith( $haystack, $needle )
{
    return substr_compare( $haystack, $needle, -strlen( $needle ) ) === 0;
}

function decamelize( $string ) {
	return ltrim( strtolower( preg_replace( '/[A-Z]([A-Z](?![a-z]))*/', '_$0', $string ) ), '_' );
	return strtolower( preg_replace( [ '/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/' ], '$1_$2', $string ) );
}

function localdate( $date )
{
	return date( 'Y年n月j日', strtotime( $date ) );
}

function cut_chinese_sentence( $text, $max_length = 50 )
{
	$t = explode( '。', $text );

	$l = 0;
	foreach ( $t as $k => $a )
	{
		if ( ( $l += iconv_strlen( $a ) ) > $max_length )
		{
			if ( $k > 0 )
			{
				$text = implode( '。', array_slice( $t, 0, $k ) ) . "。";
			}
		}
	}

	if ( iconv_strlen( $text ) > $max_length )
	{
		$text = iconv_substr( $text, 0, $max_length ) . "...";
	}


	return $text;
}

function is_mobile_number( $num )
{
    return (bool) preg_match( '/^1[3456789]\d{9}$/', $num );
}


function idcard_verify(string $id, string $name ): array
{
    global $config;

    $host = "https://naidcard.market.alicloudapi.com";
    $path = "/nidCard";
    $method = "GET";
    $appcode = $config[ 'idcard_verify' ][ 'appcode' ];//开通服务后 买家中心-查看AppCode
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "idCard=" . urlencode($id)."&name=" . urlencode($name);

    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    if (1 == strpos("$" . $host, "https://")) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $out_put = curl_exec($curl);

    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    list($header, $body) = explode("\r\n\r\n", $out_put, 2);

    if ($httpCode == 200) {
        $json = json_decode( $body, true);

        global $app;
        $query = "insert into idcard_log (
            `name`, `idcard`, `result`, `sex`, `area`, `province`, `city`, `prefecture`, `birthday`, `addrCode`, `lastCode`, `msg`, `code`
        ) values ("
            . $app->db()->quote( $name ) . ', '
            . $app->db()->quote( $id ) . ', '
            . $app->db()->quote( $json[ 'status' ] == '01' ? 'Y' : 'N' ) . ', '
            . $app->db()->quote( $json[ 'sex' ] ) . ', '
            . $app->db()->quote( $json[ 'area' ] ) . ', '
            . $app->db()->quote( $json[ 'province' ] ) . ', '
            . $app->db()->quote( $json[ 'city' ] ) . ', '
            . $app->db()->quote( $json[ 'prefecture' ] ) . ', '
            . $app->db()->quote( $json[ 'birthday' ] ) . ', '
            . $app->db()->quote( $json[ 'addrCode' ] ) . ', '
            . $app->db()->quote( $json[ 'lastCode' ] ) . ', '
            . $app->db()->quote( $json[ 'msg' ] ) . ', '
            . $app->db()->quote( $json[ 'status' ] ) .
        " )";

        $app->db()->exec( ($query ) );

        if ( $json[ 'status' ] == '01')
        {
            return [ 'code' => 0, 'message' => '验证通过', 'data' => $json ];
        }
        else {
            $message = '';
            switch ($json[ 'status' ])
            {
                case '02':
                case '204':
                case '205':
                    $message = str_replace( '！', '', $json[ 'msg' ]) ;
                    break;
                case '202':
                    $message = '无法验证' ;
                    break;
                default:
                    $message = 'api异常';
                    break;
            }
            return [ 'code' => 1, 'message' => $message, 'data' => $json ];
        }
        //print("正常请求计费(其他均不计费)<br>");
        //print($body);
    }
    else {
        ob_start();

        if ($httpCode == 400 && strpos($header, "Invalid Param Location") !== false) {
            print("参数错误");
        } elseif ($httpCode == 400 && strpos($header, "Invalid AppCode") !== false) {
            print("AppCode错误");
        } elseif ($httpCode == 400 && strpos($header, "Invalid Url") !== false) {
            print("请求的 Method、Path 或者环境错误");
        } elseif ($httpCode == 403 && strpos($header, "Unauthorized") !== false) {
            print("服务未被授权（或URL和Path不正确）");
        } elseif ($httpCode == 403 && strpos($header, "Quota Exhausted") !== false) {
            print("套餐包次数用完");
        } elseif ($httpCode == 403 && strpos($header, "Api Market Subscription quota exhausted") !== false) {
            print("套餐包次数用完，请续购套餐");
        } elseif ($httpCode == 500) {
            print("API网关错误");
        } elseif ($httpCode == 0) {
            print("URL错误");
        } else {
            print("参数名错误 或 其他错误");
            print($httpCode);
            $headers = explode("\r\n", $header);
            $headList = array();
            foreach ($headers as $head) {
                $value = explode(':', $head);
                $headList[$value[0]] = $value[1];
            }
            print($headList['x-ca-error-message']);
        }

        $msg = ob_get_clean();

        return [ 'code' => 2, 'message' => 'api错误', 'data' => [ 'http_code' => $httpCode, 'message' => $msg ] ];

    }

}

function gmt_iso8601( $time )
{
	return str_replace( '+00:00', '.000Z', gmdate( 'c', $time ) );
}
