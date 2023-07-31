<?php

if ( isset( $_POST[ 'pass' ] ) )
{
	$people = new People( $id );

	if ( $people->couldReview() )
	{
		$people->review( $id, $pass, $_POST[ 'comment' ] );
		$app->showFriendlyMessage( '审核完成。' );
	}
	else
	{
		$app->showFriendlyMessage( '您没有权限。' );
	}


}

$people = new People( $id );
$people->getFiles();

debug ( $people );
