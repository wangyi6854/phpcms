<?php


const ADMIN = 1;

try
{

	require_once './init.php';

	$module = $module == 'index' ? 'admin.index' : $module;
	$config[ 'cache_enable' ] = false;

	if ( empty( $_GET['module'] ) || $_GET['module'] != 'admin.login' )
	{
		require ROOT . '/include/session.php';

		$user = new User( $_SESSION[ 'uid' ] );

		if ( $user->needChangePassword() && $module != 'admin.password.modify' )
		{
			header( "Location: ./?module=admin.password.modify" );
			exit();
		}
	}

	check_module( $module );

	$tpl = $tpl ? $tpl : $module;

	$app = new App();

	if ( !in_array( $module, [ 'admin.login', 'admin.password.modify', ] ) && !$app->modulePrivilege() )
	{

		header( 'Location: ./?module=admin.login' );
		exit();
	}

	require_once ROOT . "/module/$module.php";

	$header_nav_items = $app->headerItems();

	$page_title = $page_title ? $page_title . ' - ' . $config['site_name'] : $config['site_name'];

	if ( !$direct_output )
	{
		if ( $format == 'json' )
		{
			echo json_encode( array_merge( array( 'return' => 0, 'message' => '', 'data' => $data ), $ext_data ), JSON_UNESCAPED_UNICODE );
		}
		else
		{
			check_tpl( $tpl );

			require_once ROOT . "/tpl/$tpl.php";
		}
	}
}
catch ( Exception $e )
{
	$code = $e->getCode();
	$message = $e->getMessage();

	if ( $format == 'json' )
	{
		echo json_encode( array( 'return' => $code, 'message' => $message, 'data' => null ), JSON_UNESCAPED_UNICODE );
	}
	else
	{
		show_message( $message );
	}
}

