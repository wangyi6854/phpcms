<?php

if ( !empty( $_POST[ 'title' ] ) )
{
	$_POST[ 'content' ] = !empty( $_POST[ 'content' ] ) ? $_POST[ 'content' ] : '';

	$news = new Course( $_POST );
	$news->setNotSavingColumns( [ 'count' ] );

	if ( $news->save() )
	{
		$app->showFriendlyMessage( '编辑完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '编辑失败。' );
	}
}

$news_obj = new Course( $id );

$news = $news_obj->output();

$sites = $app->enumValuesFromCache('course', 'site' );
$sexes = $app->enumValuesFromCache('course', 'sex' );
$courseSeasonList = $app->courseSeasonList();

if ( !$id )
{
	//$news->postDate = date( 'Y-m-d H:i:s' );
}

$plain_text_editor_cats = [];