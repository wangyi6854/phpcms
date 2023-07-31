<?php

if ( $_SESSION[ 'type' ] > 2 )
{
	header( 'Location: ./' );
	exit();
}


$data = new Submission( $id );

if ( $data->reviewer != $_SESSION[ 'uid' ] && $data->finalReviewer != $_SESSION[ 'uid' ] )
{
	$app->showFriendlyMessage( "此材料不属于你" );
}


if ( $data->pass( $pass, $reviewMemo ) )
{
	$app->showFriendlyMessage( "审核完成", './?module=admin.review.list' );
}
else
{
	$app->showFriendlyMessage( "无法审核。请稍候再试。" );
}
