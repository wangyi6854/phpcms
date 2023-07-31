<?php

require ROOT . '/lib/AliVod.php';

//$name = 'd:\\1.mp4';
//$title = '1';
//$code = 'ca05e5f3aaaf41a3b0166e2610f26e64';

if ( $code )
{
	$vod = new AliVod();

	$format = 'json';

	$data = $vod->GetPlayInfo( [
		                                 'VideoId'  => $code,
	                                 ] );

	if ( !empty( $data[ 'Code' ] ) )
	{
		$json_result = 1;
		$message = '无法获取文件';
	}

}