<?php

$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];


$list = ( new CourseApplyList([
	'site'		=> $site,
	'page'		=> $page,
	'pagesize'	=> $pagesize,
	'keyword'	=> $keyword,
]) )->output();

$sites = $app->enumValuesFromCache('course', 'site' );


