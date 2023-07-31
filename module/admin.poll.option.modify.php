<?php

if ( !empty( $_POST[ 'title' ] ) )
{
	$_POST[ 'content' ] = !empty( $_POST[ 'content' ] ) ? $_POST[ 'content' ] : '';

	$news = new PollOption( $_POST );
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

$news_obj = new PollOption( $id );

$news_obj->pollId = $news_obj->pollId ?: $poll_id;

$news = $news_obj->output();

$optioncat_list = $app->db()->simpleQuery( "select id, title from poll_option_cat where pollId = " . $news_obj->pollId );
$type1_list = $app->enumValuesFromCache('poll_option', 'type1' );
$type2_list = $app->enumValuesFromCache('poll_option', 'type2' );
$street_list = $app->enumValuesFromCache('poll_option', 'street' );

$plain_text_editor_cats = [];