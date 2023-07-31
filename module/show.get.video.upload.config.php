<?php
require ROOT . '/lib/AliVod.php';

//$name = 'd:\\1.mp4';
//$title = '1';
$videoId = '';

if ( $name && $title )
{
	$vod = new AliVod();

	$format = 'json';

	$data = $vod->createUploadVideo( [
		                                 'FileName' => $name,
		                                 'Title'    => $title,
		                                 'CateId'   => '1000424100',
		                                 'UserData' => json_encode( [
			                                                            'MessageCallback' => [
				                                                            "CallbackURL" => 'https://new.qdsnqwhg.cn:8002/?module=aliyun.callback',
			                                                            ],
		                                                            ] ),
		                                 //'TemplateGroupId'  => 'fc1cebd21af1128d9d3beecd6a3fc4a2',
	                                 ] );

	if ( !empty( $data[ 'Code' ] ) )
	{
		$json_result = 1;
		$message     = '目前无法上传文件';
	}
	else
	{
		$videoId = $data[ 'VideoId' ];
	}
}

if ( $code )
{
	$vod = new AliVod();

	$format = 'json';

	$data = $vod->refreshUploadVideo( [
		                                  'VideoId' => $code,
	                                  ] );

	if ( !empty( $data[ 'Code' ] ) )
	{
		$json_result = 1;
		$message     = '无法刷新文件';
	}
	else
	{
		$videoId = $data[ 'VideoId' ];
	}

}

if ( $videoId )
{
	$query = "insert into aliyun_video ( videoId ) VALUE ( " . $app->db()->quote( $videoId ) . " )";
	$app->db()->exec( $query );

}
