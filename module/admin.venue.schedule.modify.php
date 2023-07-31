<?php

if ( !empty( $_POST[ 'name' ] ) )
{
	$news = new VenueSchedule( $_POST );
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

$news = new VenueSchedule( $id );


$names = $app->enumValuesFromCache('venue_schedule', 'name' );
$sexex = $app->enumValuesFromCache('venue_schedule', 'sex' );


$plain_text_editor_cats = [];