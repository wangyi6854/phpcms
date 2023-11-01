<?php

if ( !empty( $_POST[ 'title' ] ) )
{
	$_POST[ 'content' ] = !empty( $_POST[ 'content' ] ) ? $_POST[ 'content' ] : '';
	$_POST[ 'content' ] = str_replace( "http://" . $_SERVER[ 'HTTP_HOST' ], '', $_POST[ 'content' ] );

	$news = new Tag( $_POST );


    if ( $news->save() )
	{
		$app->showFriendlyMessage( '编辑完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '编辑失败。' );
	}

}

$news_obj = new Tag( $id );

$news = $news_obj->output();

