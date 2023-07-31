<?php


session_set_cookie_params( 0, $config['session_cookie_path'] );
session_start();

if ( !isset ( $_SESSION[ 'return_to' ] ) )
{
	$_SESSION[ 'return_to' ] = '';
}

if ( empty( $_SESSION[ 'uid' ] ) || $_SESSION[ 'type' ] != 0 )
{
	header( 'Location: ./?module=admin.login' );
	exit();
}

