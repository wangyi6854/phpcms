<?php

$page_start_time = microtime( true );

if ( !empty( $_SERVER['HTTP_X_REAL_IP'] ) || !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
{
	$_SERVER['REMOTE_ADDR'] = !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['HTTP_X_REAL_IP'];
	unset( $_SERVER['HTTP_X_REAL_IP'] );
	unset( $_SERVER['HTTP_X_FORWARDED_FOR'] );
}
$_SERVER['REMOTE_ADDR'] = !empty( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '';

$_SERVER[ 'DOCUMENT_ROOT' ] = !empty( $_SERVER[ 'DOCUMENT_ROOT' ] ) ? $_SERVER[ 'DOCUMENT_ROOT' ] : __DIR__;
$_SERVER[ 'DOCUMENT_ROOT' ] = rtrim( $_SERVER[ 'DOCUMENT_ROOT' ], '/' );
$_SERVER[ 'QUERY_STRING' ] = !empty( $_SERVER[ 'QUERY_STRING' ] ) ? $_SERVER[ 'QUERY_STRING' ] : '';
$_SERVER[ 'REQUEST_URI' ] = !empty( $_SERVER[ 'REQUEST_URI' ] ) ? $_SERVER[ 'REQUEST_URI' ] : $_SERVER[ 'SCRIPT_NAME' ] . '?' . $_SERVER[ 'QUERY_STRING' ];

const ROOT = __DIR__;
define( "HOME", ltrim( preg_replace( '#[^/]+#', '..', str_replace( '\\', '/', dirname( $_SERVER[ 'SCRIPT_NAME' ] . 'a' ) ) ), '/' ) );
const PAGESIZE = 10;

require ROOT . '/config/config.php';
require ROOT . '/config/config-secret.php';

$config = $config + $config_secret;

require ROOT . '/include/function.php';
require ROOT . '/include/site.php';

$debug = [];

register_shutdown_function( 'shutdown' );
spl_autoload_register('my_autoloader');
$old_error_handler = set_error_handler("error_handler");
$old_exception_handler = set_exception_handler('exception_handler');

$_SERVER['SERVER_NAME'] = !empty( $_SERVER['SERVER_NAME'] ) ? $_SERVER['SERVER_NAME'] : '';
$_SERVER['HTTP_USER_AGENT'] = empty( $_SERVER['HTTP_USER_AGENT'] ) ? 'Unknown User Agent' : $_SERVER['HTTP_USER_AGENT'];
$_SERVER['HTTP_REFERER'] = empty( $_SERVER['HTTP_REFERER'] ) ? '' : $_SERVER['HTTP_REFERER'];
$ip = $_SERVER["REMOTE_ADDR"] ?? '0.0.0.0';
$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];

$config[ 'cache_enable' ] = false;
define( 'DEBUG', 1 );

if ( in_array( $ip, array( '127.0.0.1', '172.31.0.1', '172.31.0.4' ) ) )
{
	define( 'DEBUG', 1 );
	$config[ 'cache_enable' ] = false;
}

if ( defined( 'DEBUG' ) )
{
	error_reporting( E_ALL | E_STRICT );
	ini_set( 'display_errors', '1' );
	ini_set( 'log_errors', 1 );
	//xdebug_enable();
}


date_default_timezone_set( $config[ 'timezone' ] );
setlocale( LC_ALL, $config[ 'locale' ] );

init_env();

if ( PHP_SAPI != 'cli' )
{
	while ( ob_get_level() )
	{
		@ob_end_clean();
	}

	ini_set( 'zlib.output_compression', 0 );
	ob_start();

}

$now = date( 'Y-m-d H:i:s' );

$cache = Cache::singleton();

$referer = empty( $_SERVER["HTTP_REFERER"] ) ? '' : $_SERVER["HTTP_REFERER"];
$user_agent = empty( $_SERVER["HTTP_USER_AGENT"] ) ? '' : strtolower( $_SERVER["HTTP_USER_AGENT"] );
$http_accept = empty( $_SERVER["HTTP_ACCEPT"] ) ? '' : strtolower( $_SERVER["HTTP_ACCEPT"] );

$data = array();
$ext_data = array();

$msg = '';

$page_url = "://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]";

$pagesize = $pagesize ?? PAGESIZE;
$offset = ( $page - 1 ) * $pagesize;

$post_process = '';

$extra_header = '';
$extra_footer = '';
$standalone_output = false;
$additional_header = '';

$direct_output = str_contains( PHP_SAPI, 'cli' );

$page_title			= $config[ 'site_name' ];
$page_keywords		= $config[ 'site_name' ];
$page_description	= $config[ 'site_name' ];

/*
echo "<pre>";
var_dump( $_SERVER );
exit();
*/
