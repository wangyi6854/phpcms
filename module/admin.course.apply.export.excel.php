<?php
require ROOT . '/vendor/autoload.php';

$direct_output = true;

if ( $course )
{
	list( $filename, $xlsx ) = $app->exportCourseApplication( $course, $site );
	$app->sendBinaryFile( $filename, $xlsx, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
}
else
{
	$tmp_filename = tempnam( sys_get_temp_dir(), "zip" );
	$zip = new ZipArchive;
	if ( ( $result = $zip->open($tmp_filename, ZipArchive::OVERWRITE ) ) === TRUE) {
		foreach ( $app->db()->simpleQuery( "select id from course" ) as $c )
		{
			list( $filename, $xlsx ) = $app->exportCourseApplication( $c[ 'id' ], $site );
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
