<?php

$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];


$list = ( new CourseList([
	'site'		=> $site,
	'page'		=> $page,
	'pagesize'	=> $pagesize,
	'keyword'	=> $keyword,
	'order'		=> 'id desc'
]) )->output();

$sites = $app->enumValuesFromCache('course', 'site' );

$courses = [];
foreach ( $app->db()->simpleQuery( "select id from course" ) as $c )
{
	$courses[] = $c[ 'id' ];
}
