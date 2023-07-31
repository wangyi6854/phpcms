<?php
require ROOT . '/vendor/autoload.php';

$direct_output = true;

if ( $id )
{
	if ( $type == 'sms' )
	{
		list( $filename, $xlsx ) = $app->exportTicketApplicationForSMS( $id );
		$app->sendBinaryFile( $filename, $xlsx, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
	}
	else
	{
		list( $filename, $xlsx ) = $app->exportTicketApplication( $id );
		$app->sendBinaryFile( $filename, $xlsx, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
	}
}
else
{
	$tmp_filename = tempnam( sys_get_temp_dir(), "zip" );
	$zip = new ZipArchive;
	if ( ( $result = $zip->open($tmp_filename, ZipArchive::OVERWRITE ) ) === TRUE) {
		foreach ( $app->db()->simpleQuery( "select id from ticket" ) as $c )
		{
			list( $filename, $xlsx ) = $app->exportTicketApplication( $c[ 'id' ] );
			$zip->addFromString($filename, $xlsx );
		}
		$zip->close();
	} else {
		echo 'failed' . $result;
	}

	$content = file_get_contents( $tmp_filename );

	unlink( $tmp_filename );

	$app->sendBinaryFile( '报名结果.zip', $content, "application/zip" );

}

exit();
