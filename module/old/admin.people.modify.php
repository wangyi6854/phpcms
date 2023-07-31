<?php

if ( !empty( $_POST[ 'name' ] ) )
{

	if ( $_SESSION[ 'type' ] == 2 )
	{
		$_POST[ 'status' ] = '初审通过';
	}
	elseif ( $_SESSION[ 'type' ] == 1 )
	{
		$_POST[ 'status' ] = '家协审核通过';
	}

	$people = new People( $_POST );
	$people->getFiles();

	if ( $people->save() )
	{
		$app->showFriendlyMessage( '编辑完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '编辑失败。' );
	}

}

$people = new People( $id );
$people->getFiles();

$leixing_enum = $app->setValuesFromCache( 'people', 'leixing' );
$jibie_enum = $app->setValuesFromCache( 'people', 'jibie' );
$neirong_enum = $app->setValuesFromCache( 'people', 'neirong' );
$quyu_enum = $app->setValuesFromCache( 'people', 'quyu' );
$shuxiang_enum = $app->enumValuesFromCache( 'people', 'shuxiang' );
