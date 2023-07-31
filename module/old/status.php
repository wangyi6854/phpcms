<?php

if ( empty( $_SESSION[ 'uid' ] ) )
{
	header( 'Location: ./?module=login' );
	exit();
}

$uid = $_SESSION[ 'uid' ];

$people = new People( $uid );

$list = $app->latestReviewList( $uid );

switch ( @$list[ 0 ][ 'status' ] )
{
	case '家协审核通过':
		$current_step = 4;
		break;

	case '家协审核中':
	case '家协审核不通过':
	case '初审通过':
		$current_step = 3;
		break;

	case '初审不通过':
	case '初审中':
		$current_step = 2;
		break;

	case '待审核':
		$current_step = 1;
		break;

	default :
		$current_step = 0;
}

$finished = $current_step == 4;
