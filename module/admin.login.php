<?php


$page_title = '登录';

if ( !empty( $_POST['password'] ) )
{
	session_start();

	if ( $app->loginWithPassword( $_POST['username'], $_POST['password'] ) )
	{
		$app->showMessage( '登录成功', './' );
	}
	else
	{
		$app->showMessage( '用户名或密码错误', './?module=admin.login' );
	}

}


