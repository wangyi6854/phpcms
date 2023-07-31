<?php
require_once ROOT . './lib/AliSMS.php';

$direct_output = true;

foreach ( $app->db()->query( "select * from sms_job where status = '未发送' order by id limit 10 " ) as $row )
{
	$sms = new AliSMS();

	$sms->setTemplateCode( $row[ 'template' ] );

	if ( $sms->sendSMS( $row[ 'phone' ], json_decode( $row[ 'data' ] ), true ) )
	{
		$app->db()->exec( "update sms_job set status = '已发送' where id = " . $row[ 'id' ] ) ;
	}
	else
	{
		$app->db()->exec( "update sms_job set status = '错误' where id = " . $row[ 'id' ] ) ;
	}
}