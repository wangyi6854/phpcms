<?php

if ( $_SESSION[ 'type' ] > 1 )
{
	header( 'Location: ./' );
	exit();
}


if ( !empty( $_POST[ 'content' ] ) )
{

	$obj = new Requirement( $_POST );

	if ( $obj->save() )
	{
		$app->showFriendlyMessage( '修改成功。' );
	}
	else
	{
		$app->showFriendlyMessage( '无法修改。' );
	}
}

$data = new Requirement( $id );
