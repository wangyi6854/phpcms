<?php

if ( $_SESSION[ 'type' ] > 1 )
{
	header( 'Location: ./' );
	exit();
}


if ( !empty( $_POST[ 'status' ] ) )
{

	$target_user = new User( $id );

	$password = trim( $password );

	if ( !empty( $password ) )
	{
		$target_user->password = $password;
	}

	$target_user->status = $_POST[ 'status' ];

	if ( $target_user->save() )
	{
		$app->showFriendlyMessage( '修改成功。' );
	}
	else
	{
		$app->showFriendlyMessage( '无法修改。' );
	}
}

$target_user = new User( $id );
