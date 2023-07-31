<?php

if ( $_SESSION[ 'type' ] > 1 )
{
	header( 'Location: ./' );
	exit();
}


$user = new User( (int) $_SESSION[ 'uid' ] );


if ( $user->type > 1 )
{
	header( 'Location: ./' );
	exit();
}

$query = "select sql_calc_found_rows * from schedule order by id desc";

list( $list, $num_result ) = $app->db->queryPage2( $query, $page, $pagesize );

