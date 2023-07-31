<?php

if ( !empty( $_POST[ 'title' ] ) )
{
	$news = new Poll( $_POST );

	if ( $news->save() )
	{
		$app->showFriendlyMessage( '编辑完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '编辑失败。' );
	}
}

$news_obj = new Poll( $id );

$news = $news_obj->output();

$plain_text_editor_cats = [];