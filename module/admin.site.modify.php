<?php

if ( !empty( $_POST[ 'name' ] ) )
{
	$news = new Site( $_POST );

	if ( $news->save() )
	{
		$app->showFriendlyMessage( '编辑完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '编辑失败。' );
	}
}

$news_obj = new site( $id );

$news = $news_obj->output();

$plain_text_editor_cats = [];