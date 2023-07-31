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

$data->project = new Project( $data->projectId );
$data->project->getFullContents();

$data->user = new User( (int) $data->submitter );

$data->filesInfo = [];

$files = explode( ',', $data->files );
foreach ( $files as $fileId )
{
	if ( !$fileId )
	{
		continue;
	}

	$file = new File( (int) $fileId );
	$file->getImages();
	$data->filesInfo[] = $file;
}

