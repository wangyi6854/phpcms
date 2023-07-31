<?php

if ( $data = $app->verifySMSCode( $mobile, $code ) )
{
    $app->login($mobile);
}

$format = 'json';
