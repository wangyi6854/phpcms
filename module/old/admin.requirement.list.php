<?php

if ( $_SESSION[ 'type' ] > 1 )
{
	header( 'Location: ./' );
	exit();
}

$where = '';

if ( $keyword )
{
	$where .= "where content like " . $app->db->quote( "%$keyword%" );
}

$query = "select sql_calc_found_rows * from requirement $where";


list( $list, $num_result ) = $app->db->queryPage2( $query, $page, $pagesize );

$_SESSION[ 'return_to' ] =  $_SERVER[ 'REQUEST_URI' ];

