<?php
if ( $_SESSION[ 'type' ] > 1 )
{
	header( 'Location: ./' );
	exit();
}


if ( !empty( $_POST[ 'description' ] ) )
{
	$schedule = new Schedule( $_POST );

	if ( $schedule->save() )
	{
		$app->showFriendlyMessage( "报送时间保存完成", './?module=admin.schedule.list' );
	}
	else
	{
		$app->showFriendlyMessage( "报送时间保存失败。请稍候再试。", "./?module=admin.schedule.list" );
	}
}

$data = new Schedule( $id );

