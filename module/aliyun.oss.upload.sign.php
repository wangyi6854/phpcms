<?php

$direct_output = true;


$accessKeyId = $config['OSS']['accessKeyId'];
$key         = $config['OSS']['accessKeySecret'];
$host = 'https://' . $config['OSS']['ossBucketDomainName'];
$callbackUrl = external_host_prefix() . '/?module=aliyun.oss.callback';
$dir         = 'ssx/2022/';

$callback_param  = array(
	'callbackUrl'      => $callbackUrl,
	'callbackBody'     => 'filename=${object}&size=${size}&mimeType=${mimeType}&height=${imageInfo.height}&width=${imageInfo.width}',
	'callbackBodyType' => "application/x-www-form-urlencoded",
);
$callback_string = json_encode( $callback_param );

$base64_callback_body = base64_encode( $callback_string );
$now                  = time();
$expire               = 30;
$end                  = $now + $expire;
$expiration           = gmt_iso8601( $end );


//最大文件大小.用户可以自己设置
$condition    = array( 0 => 'content-length-range', 1 => 0, 2 => 1048576000 );
$conditions[] = $condition;

// 表示用户上传的数据，必须是以$dir开始，不然上传会失败，这一步不是必须项，只是为了安全起见，防止用户通过policy上传到别人的目录。
$start        = array( 0 => 'starts-with', 1 => '$key', 2 => $dir );
$conditions[] = $start;


$arr            = array( 'expiration' => $expiration, 'conditions' => $conditions );
$policy         = json_encode( $arr );
$base64_policy  = base64_encode( $policy );
$string_to_sign = $base64_policy;
$signature      = base64_encode( hash_hmac( 'sha1', $string_to_sign, $key, true ) );

$response                = array();
$response[ 'accessid' ]  = $accessKeyId;
$response[ 'host' ]      = $host;
$response[ 'policy' ]    = $base64_policy;
$response[ 'signature' ] = $signature;
$response[ 'expire' ]    = $end;
$response[ 'callback' ]  = $base64_callback_body;
$response[ 'dir' ]       = $dir;  // 这个参数是设置用户上传文件时指定的前缀。
$response[ '$callbackUrl' ]       = $callbackUrl;  // 这个参数是设置用户上传文件时指定的前缀。

header("Content-type: application/json");
echo json_encode( $response );
