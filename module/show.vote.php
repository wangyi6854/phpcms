<?php

$votes = [];

foreach ( explode( ',', $_GET[ 'votes' ] ) as $v )
{
	$votes[] = $app->db()->quote( $v );
}

$data = '每人每天最多投5票';

if ( isset( $_SESSION[ 'last_vote_time' ] ) )
{
	if ( $_SESSION[ 'last_vote_time' ] < time() - 86400 )
	{
		$_SESSION[ 'last_vote_time' ] = time();
		$_SESSION[ 'today_vote_count' ] = 0;
	}
}
else
{
	$_SESSION[ 'last_vote_time' ] = time();
	$_SESSION[ 'today_vote_count' ] = 0;
}

if ( $_SESSION[ 'today_vote_count' ] + count( $votes ) <= 5 )
{
	$query = "update poll_option set `count` = `count` + 1 where id in ( " . implode( ',', $votes ) . " )";

	if ( $app->db()->exec( $query ) )
	{
		$_SESSION[ 'today_vote_count' ] = $_SESSION[ 'today_vote_count' ] + count( $votes );
		$data = "投票成功";
	}
}

$format = 'json';




