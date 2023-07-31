<?php

if ( $id )
{
	$data = new Submission( $id );
}
else
{
	header( "Location: ./" );
	exit();
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

