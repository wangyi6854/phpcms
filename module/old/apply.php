<?php

if ( empty( $_SESSION[ 'uid' ] ) )
{
	header( 'Location: ./?module=login' );
	exit();
}

$id = $_SESSION[ 'uid' ];

if ( !empty( $_POST ) )
{
	$_POST[ 'id' ] = $id;

	$people = new People( $_POST );

	//debug( $people );

	if ( $json_result = (int) $people->save() )
	{
		$app->addReview( $id );
	}

	$format = 'json';

	$message = "";
}
else
{
	$people = new People( $id );
	$people->getFiles();

	$people->idcard = array_merge( $people->idcard, [ [], [] ] );
	$people->idcard = array_slice( $people->idcard, 0, 2 );

	$leixing_enum = $app->setValuesFromCache( 'people', 'leixing' );
	$jibie_enum = $app->setValuesFromCache( 'people', 'jibie' );
	$neirong_enum = $app->setValuesFromCache( 'people', 'neirong' );
	$quyu_enum = $app->setValuesFromCache( 'people', 'quyu' );
	$shuxiang_enum = $app->enumValuesFromCache( 'people', 'shuxiang' );
}

//debug( $people );