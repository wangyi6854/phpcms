<?php

$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];


$list = ( new VenueScheduleList([
    'parts'     => $name ? [ 'name = ' . $app->db()->quote( $name ) ] : [],
	'page'		=> $page,
	'pagesize'	=> $pagesize,
	'keyword'	=> $keyword,
	'order'		=> 'id desc'
]) )->output();


$venues = $app->enumValuesFromCache('venue_schedule', 'name' );

