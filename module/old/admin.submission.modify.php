<?php

if ( !empty( $_POST[ 'rrid' ] ) )
{
	$_POST[ 'relScheduleRelProjectUserId' ] = $_POST[ 'rrid' ];

	$submission = new Submission( $_POST );

	if ( !$submission->isMine() )
	{
		$app->showFriendlyMessage( "你不需要报送此材料" );
	}

	if ( $submission->save() )
	{
		$app->showFriendlyMessage( "材料上报完成" );
	}
	else
	{
		$app->showFriendlyMessage( "材料上报失败。请稍候再试。" );
	}
}

if ( $id )
{
	$data = new Submission( $id );
}
else
{
	$data = new Submission( [
		'relScheduleRelProjectUserId'	=> $rrid
	] );
}

if ( !$data->isMine() )
{
	$app->showFriendlyMessage( "你不需要报送此材料" );
}


$projectId = $data->projectId ?: $projectId;

if ( !$projectId )
{
	header( 'Location: ./?module=admin.submission.list' );
	exit();
}

$data->project = new Project( $projectId );
$data->project->getFullContents();

$data->filesInfo = [];

$files = explode( ',', $data->files );
foreach ( $files as $fileId )
{
	if ( !$fileId )
	{
		continue;
	}

	$file = new File( (int) $fileId );
	$data->filesInfo[] = [
		'id'	=> $file->id,
		'url'	=> $file->url,
		'name'	=> $file->name,
	];
}

