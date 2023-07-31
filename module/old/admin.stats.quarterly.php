<?php

if ( $_SESSION[ 'type' ] > 2 )
{
	//header( 'Location: ./' );
	//exit();
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

$scheduleId = $schedule->id;


// 个单位情况
$where = "where scheduleId = $scheduleId";

$query = "select count(*) as cnt, status, submitterName, submitter, userStatus from v_submission $where group by status, submitterName";

$list = $users = [];
$result = $app->db->simpleQuery( $query );
foreach ( $result as $row )
{
	if ( !in_array( $row[ 'submitterName' ], $users ) )
	{
		$users[] = $row[ 'submitterName' ];
	}

	$index = array_search( $row[ 'submitterName' ], $users );

	if ( !array_key_exists( $index, $list ) )
	{
		$list[ $index ] = [ $row[ 'submitterName' ], 0, 0, $row[ 'submitter' ], $row[ 'userStatus' ] ];
	}

	$list[ $index ][ 2 ] += (int) $row[ 'cnt' ];

	if ( $row[ 'status' ] == '通过' )
	{
		$list[ $index ][ 1 ] = (int) $row[ 'cnt' ];
	}
}

usort( $list, function( $a, $b ) { return $b[ 1 ] <=> $a[ 1 ]; } );


/*

// 总体情况
$where = "where rStartTime <= " . $app->db->quote( $schedule[ 'submitStart' ] ) . " and rEndTime >= " . $app->db->quote( $schedule[ 'review2End' ] );
//$where .= " and status = '通过'"'
$query = "select count(*) as cnt, status from v_submission $where group by status order by status";

$total_list = $app->db->simpleQuery( $query );

$total_cnt = $total_pass_cnt = $total_unpass_cnt = 0;
foreach ( $total_list as $t )
{
	$total_cnt += (int) $t[ 'cnt' ];

	if ( $t[ 'status' ] == '通过' )
	{
		$total_pass_cnt = (int) $t[ 'cnt' ];
	}

	if ( $t[ 'status' ] == '未通过' )
	{
		$total_unpass_cnt = (int) $t[ 'cnt' ];
	}
}
$total_pass_rate = round( ( $total_pass_cnt / $total_cnt ) * 100, 1 );
$total_unpass_rate = round( ( $total_unpass_cnt / $total_cnt ) * 100, 1 );

*/
$total_pass_rate = 0;
$total_unpass_rate = 0;

$currentScheduleId = $scheduleId;
