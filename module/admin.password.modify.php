<?php

if ( !empty( $_POST[ 'password' ] ) && !empty( $_POST[ 'old_password' ] ) )
{
	$user = new User( (int) $_SESSION[ 'uid' ] );

	if ( $_POST[ 'old_password' ] == $user->password )
	{
		$user->password = $_POST[ 'password' ];
		if ( $user->save() )
		{
			$app->showFriendlyMessage( '密码修改成功，请重新登录。', './?module=admin.logout' );
		}
		else
		{
			$app->showFriendlyMessage( '无法修改密码。', './?module=admin.password.modify' );
		}
	}
	else
	{
		$app->showFriendlyMessage( '旧密码不对。', './?module=admin.password.modify' );
	}
}


