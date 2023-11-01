<?php

if ( !empty( $_POST[ 'action' ] ) )
{
	$news = new News( $id );


    if ( $news->save() )
	{
		$app->showFriendlyMessage( '审核完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '审核失败。' );
	}

}

$news_obj = new News( $id );

$news = $news_obj->output();

