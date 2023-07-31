<?php

if ( !empty( $_POST[ 'title' ] ) )
{
	$_POST[ 'content' ] = !empty( $_POST[ 'content' ] ) ? $_POST[ 'content' ] : '';

	$news = new Ticket( $_POST );
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

$news_obj = new Ticket( $id );

$news = $news_obj->output();

$sexes = $app->enumValuesFromCache('course', 'sex' );

$plain_text_editor_cats = [];