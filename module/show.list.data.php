<?php

$format = 'json';

$cacheKey = "poll_data_$poll_id";

if ( isset( $cache->$cacheKey ) )
{
	$data = $cache->$cacheKey;
}
else
{
	$data = [];

	foreach ( $app->db()->query( "select id, title from poll_option_cat where pollId = $poll_id" ) as $row )
	{
		$query = "select id, name, count, image from poll_option where pollId = $poll_id and status = '通过' and optionCat = $row[id]";

		$data[] = [
			'catId'     => $row[ 'id' ],
			'catTitle'  => $row[ 'title' ],
			'list'      => $app->db()->simpleQuery( $query ),
		];
	}

	$cache->$cacheKey = $data;
}

