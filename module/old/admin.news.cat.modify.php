<?php

if ( !empty( $_POST[ 'name' ] ) )
{

	$newsCat = new NewsCat( $_POST );

	if ( $newsCat->save() )
	{
		$app->showFriendlyMessage( '编辑完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '编辑失败。' );
	}
}

$newsCat = ( new NewsCat( $id ) )->output();

$list = ( new NewsCatList( 0 ) )->output()->list;

$list = array_merge( [ ( new NewsCat( [ 'name' => '无' ] ) )->output() ], $list );



