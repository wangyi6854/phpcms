<?php


$format = 'json';

if (!is_mobile_number($mobile))
{
    $data = false;
    return;
}


$query = "select count(*) as cnt from sms_log where phone = " . $app->db()->quote( $mobile ) . " and TIMESTAMPDIFF( SECOND, ts, now() ) < 60 order by id desc limit 1";

if ( $app->db()->simpleQuery( $query, true, true ) )
{
    $data = false;
    return;
}

require ROOT . '/lib/AliSMS.php';
require ROOT . '/config-secret.php';

$sms = new AliSMS();

$sms->setTemplateCode( $config_secret[ 'AliSMS' ][ 'templateCodeForVerificationCode' ] );

$code = rand ( 1000, 9999 );

$data = $sms->send_verify($mobile, $code);




