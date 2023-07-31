<?php

$news = new News( $id );

if ( !$news->id )
{
	header( "Location: /" );
	exit();
}

if ( $news->pdf )
{

	header( "Location: " . $news->pdf );
	exit();
}

if ( $news->redirectUrl )
{
	header( "Location: " . $news->redirectUrl );
	exit();
}

$newscat = new NewsCat( $news->cat );

$sidenav_news = $app->sidenav_news();


$news->read();

$page_title = $news->title;

