<?php


if ( !$schedule = Schedule::getCurrent() )
{
	$app->showFriendlyMessage( "目前没有报送计划" );
}

$submittable = false;

if ( $schedule->inSubmit() || $schedule->inSubmit2() )
{
	$submittable = true;
}

$quoted_keyword = $app->db->quote( "%$keyword%" );

if ( $user->type == 0 )
{
	$where = "";

	if ( $keyword )
	{
		$where = "where ( title like $quoted_keyword or requirement like $quoted_keyword or content like $quoted_keyword )";
	}
}
else
{
	// 在当季之内
	$where = "where scheduleId = $schedule->id";

	if ( $keyword )
	{
		$where .= " and ( title like $quoted_keyword or requirement like $quoted_keyword or content like $quoted_keyword )";
	}

	// 属于自己提交范围内的
	$where .= " and submitter = " . $_SESSION[ 'uid' ];

	// 第一次提交
	if ( $schedule->inSubmit() )
	{
		// 提交时间符合当前审核时间范围
		//$where .= " and ( status = '待审' or status = '未填报' )";

		$time_scope_text = "[ " . date( 'Y年n月j日', strtotime( $schedule->submitStart ) ) . ' 至 ' . date( 'Y年n月j日', strtotime( $schedule->submitEnd ) ) . " ]";
	}

	// 第二次提交
	elseif ( $schedule->inSubmit2() )
	{
		// 提交时间符合当前审核时间范围
		//$where .= " and status = '复审'";

		$time_scope_text = "[ " . date( 'Y年n月j日', strtotime( $schedule->submit2Start ) ) . ' 至 ' . date( 'Y年n月j日', strtotime( $schedule->submit2Start ) ) . " ]";
	}
	else
	{
		$app->showFriendlyMessage( "目前没有需要提交的内容" );
	}

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

$query = "select sql_calc_found_rows * from v_submission $where	$order";


list( $list, $num_result ) = $app->db->queryPage2( $query, $page, $pagesize );

$_SESSION[ 'return_to' ] =  $_SERVER[ 'REQUEST_URI' ];

