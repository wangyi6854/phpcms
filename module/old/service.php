<?php

$db = $app->db();

$where = "where status = '家协审核通过'";

if ( $leixing = array_filter( (array) @$_GET[ 'leixing' ] ) )
{
	foreach ( $leixing as $l )
	{
		$ql = $db->quote( $l );
		$where .= " and FIND_IN_SET( $ql, leixing ) > 0";
	}
}


if ( $jibie = array_filter( (array) @$_GET[ 'jibie' ] ) )
{
	foreach ( $jibie as $l )
	{
		$ql = $db->quote( $l );
		$where .= " and FIND_IN_SET( $ql, jibie ) > 0";
	}
}


if ( $exp = @$_GET[ 'exp' ] )
{
	switch ( $exp )
	{
		case 1:
			$where .= " and jingyan <= 1";
			break;
		case 2:
			$where .= " and jingyan between 1 and 3";
			break;
		case 3:
			$where .= " and jingyan between 3 and 5";
			break;
		case 4:
			$where .= " and jingyan between 5 and 7";
			break;
		case 5:
			$where .= " and jingyan >= 7";
			break;
	}
}


if ( $age = @$_GET[ 'age' ] )
{
	switch ( $age )
	{
		case 1:
			$where .= " and age <= 30";
			break;
		case 2:
			$where .= " and age between 30 and 40";
			break;
		case 3:
			$where .= " and age between 40 and 50";
			break;
		case 4:
			$where .= " and age >= 50";
			break;
	}
}


if ( $neirong = array_filter( (array) @$_GET[ 'neirong' ] ) )
{
	foreach ( $neirong as $l )
	{
		$ql = $db->quote( $l );
		$where .= " and FIND_IN_SET( $ql, neirong ) > 0";
	}
}


if ( $quyu = array_filter( (array) @$_GET[ 'quyu' ] ) )
{
	foreach ( $quyu as $l )
	{
		$ql = $db->quote( $l );
		$where .= " and FIND_IN_SET( $ql, quyu ) > 0";
	}
}


if ( $shuxiang = @$_GET[ 'shuxiang' ] )
{
		$ql = $db->quote( $shuxiang );
		$where .= " and shuxiang = $ql";
}

switch ( $orderid )
{
	case 1:
		$orderby = 'order by jingyan desc';
		break;
	case 2:
		$orderby = 'order by age';
		break;
	case 3:
		$orderby = 'order by age desc';
		break;
	default:
		$orderby = 'order by id desc';
		break;
}

list( $data, $total_records ) = $db->queryPage( 'people', '*', $where, $orderby, $page, $pagesize + 1, false );

$has_next_page = count( $data ) > $pagesize;

$leixing_enum = $app->setValuesFromCache( 'people', 'leixing' );
$jibie_enum = $app->setValuesFromCache( 'people', 'jibie' );
$neirong_enum = $app->setValuesFromCache( 'people', 'neirong' );
$quyu_enum = $app->setValuesFromCache( 'people', 'quyu' );
$shuxiang_enum = $app->enumValuesFromCache( 'people', 'shuxiang' );

