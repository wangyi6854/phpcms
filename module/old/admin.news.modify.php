<?php

if ( !empty( $_POST[ 'title' ] ) )
{
	$_POST[ 'content' ] = !empty( $_POST[ 'content' ] ) ? $_POST[ 'content' ] : '';
	$_POST[ 'content' ] = str_replace( "http://" . $_SERVER[ 'HTTP_HOST' ], '', $_POST[ 'content' ] );

	$news = new News( $_POST );

	if ( $news->save() )
	{
		$app->showFriendlyMessage( '编辑完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '编辑失败。' );
	}

}

$news_obj = new News( $id );

$news = $news_obj->output();

if ( !$id )
{
	$news->postDate = date( 'Y-m-d H:i:s' );
}

$catList = (new NewsCatList())->output();

$plain_text_editor_cats = [ 5 ];