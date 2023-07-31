<?php

if ( $_SESSION[ 'type' ] > 2 )
{
	header( 'Location: ./' );
	exit();
}


if ( $scheduleId )
{
	if ( !$app->db->simpleQuery( "select id from schedule where id = $scheduleId", true, true ) )
	{
		header( 'Location: ./' );
		exit();
	}

	$schedule = new Schedule( $scheduleId );
}
else
{
	$schedule = Schedule::getCurrent();
}

if ( empty( $schedule->id ) )
{
	$app->showFriendlyMessage( "该时间段没有报送计划" );
}

if ( $keyword )
{
	$userId = User::getIdByUsername( $keyword );
}

if ( $user->type == 2 )
{
	if ( !$schedule->inReview() && !$schedule->inReview2() )
	{
		$app->showFriendlyMessage( "审核时间未到" );
	}
}
elseif ( $user->type == 1 )
{
	if ( !$schedule->inReview() && !$schedule->inReview2() && !$schedule->inReview12() && !$schedule->inReview22() )
	{
		$app->showFriendlyMessage( "审核时间未到" );
	}
}
else
{
}

$time_scope_text = "";

if ( $user->type == 0 )
{
	$where = $userId ? "where submitter = $userId" : '';
}
else
{
	// 在当季之内
	$where = "where scheduleId = $schedule->id";
	$where .= $userId ? " and submitter = $userId" : '';
	// 属于自己职权范围内的
	if ( $user->type == 1 )
	{
		$where .= " and finalReviewer = " . $_SESSION[ 'uid' ];
	}
	elseif ( $user->type == 2 )
	{
		$where .= " and reviewer = " . $_SESSION[ 'uid' ];
	}
	$where .= " and status != '未填报'";

	/*
	// 第一次审核
	if ( $schedule->inReview() )
	{
		// 提交时间符合当前审核时间范围
		$where .= " and sSubmitTime between " . $app->db->quote( $schedule->submitStart ) . " and " . $app->db->quote( $schedule->submitEnd );

		// 属于自己职权范围内的
		$where .= " and reviewer = " . $_SESSION[ 'uid' ];

		$time_scope_text = "[ " . date( 'Y年n月j日', strtotime( $schedule->reviewStart ) ) . ' 至 ' . date( 'Y年n月j日', strtotime( $schedule->reviewEnd ) ) . " ]";
	}

	// 第二次审核
	elseif ( $schedule->inReview2() )
	{
		// 提交时间符合当前审核时间范围
		$where .= " and sSubmit2Time between " . $app->db->quote( $schedule->submit2Start ) . " and " . $app->db->quote( $schedule->submit2End );

		// 属于自己职权范围内的
		$where .= " and finalReviewer = " . $_SESSION[ 'uid' ];

		$time_scope_text = "[ " . date( 'Y年n月j日', strtotime( $schedule->review2Start ) ) . ' 至 ' . date( 'Y年n月j日', strtotime( $schedule->review2End ) ) . " ]";
	}
	else
	{
		$app->showFriendlyMessage( "目前没有审核内容" );
	}
	*/
}

switch ( $sort )
{
	case 'up':
		$order = 'order by status, rrid';
		break;
	case 'down':
		$order = 'order by status desc, rrid';
		break;
	case '':
		$order = 'order by rrid';
		break;
}

$query = "select sql_calc_found_rows * from v_submission $where $order";


list( $list, $num_result ) = $app->db->queryPage2( $query, $page, $pagesize );


$_SESSION[ 'return_to' ] =  $_SERVER[ 'REQUEST_URI' ];


$currentScheduleId = $scheduleId;


