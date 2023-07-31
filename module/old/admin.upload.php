<?php

$format = 'json';

include ROOT . '/include/file_upload.php';

$data = [];

do
{
	$upload_dir = '/upload/' . date( "Y" ) . "/" . date( "m" ) . "/";
	$type = '#\.(jpe?g|png|docx?|xlsx?|pdf)$#i';
	$input_name = 'file';

	if ( !$files = upload_files( $input_name, $upload_dir, $type ) )
	{
		$message = '文件上传错误';
		$result = 1;

		break;
	}

	foreach ( $files as $f )
	{
		if ( $f[ 'result' ] )
		{
			$file = new File( [
				'name'		=> $f[ 'originalName' ],
				'path'		=> $f[ 'path' ],
				'uploadDate'	=> $now,
			] );

			if ( !$file->save() )
			{
				error_log( "can't save file to db: " . $file->path . " with name: " . $file->name );
				$data[] = [
					'message'	=> '无法保存',
					'name'		=> $file->name,
					'id'		=> 0,
				];

				$message = '文件无法保存';
				$return = 2;
			}
			else
			{
				$data[] = [
					'message'	=> '',
					'path'		=> $file->path,
					'name'		=> $file->name,
					'id'		=> $file->id,
					'size'		=> $file->size,
					'type'		=> $file->type,
				];
			}
		}
		else
		{
			$data[] = [
				'message'	=> $file[ 'message' ],
				'name'		=> $file[ 'originalName' ],
				'id'		=> 0,
			];

			$message = $file[ 'message' ];
			$return = 3;
		}
	}
}
while( 0 );

