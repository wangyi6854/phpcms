<?php
$body = file_get_contents('php://input');

if ( $message = json_decode( $body, true ) )
{
	$app->saveAliyunCallbackMessage( $message );

	//$user_data = json_decode( $message[ 'Extend' ] );

	switch ( $message[ 'EventType' ] )
	{
		case 'FileUploadComplete':
			if ( $message[ 'Status' ] == 'success' )
			{
				$app->updateAliyunVideo( $message[ 'VideoId' ], [ 'src' => $message[ 'FileUrl' ] ] );
			}
			break;
		case 'SnapshotComplete':
			if ( $message[ 'Status' ] == 'success' )
			{
				$app->updateAliyunVideo( $message[ 'VideoId' ], [ 'poster' => $message[ 'CoverUrl' ] ] );
				$app->updatePollOptionImage( 0, $message[ 'VideoId' ] );
			}
			break;
		case 'VideoAnalysisComplete':
			if ( $message[ 'Status' ] == 'success' )
			{
				$app->updateAliyunVideo( $message[ 'VideoId' ], [
					'width'  => $message[ 'Width' ],
					'height' => $message[ 'Height' ],
				] );
			}
			break;
	}

}

$direct_output = true;
