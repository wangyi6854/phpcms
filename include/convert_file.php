<?php

function get_filepath()
{
	if ( PHP_SAPI == 'cli' )
	{
		$file = $GLOBALS[ 'argv' ][ 1 ];
	}
	elseif ( !empty( $_GET[ 'file' ] ) )
	{
		$file = $_GET[ 'file' ];
	}
	else
	{
		$file = '';
	}

	if ( !$file )
	{
		log_message( "office file convertion: no file input" );
		return false;
	}

	return $file;
}

function get_fileid()
{
	if ( PHP_SAPI == 'cli' )
	{
		$id = $GLOBALS[ 'argv' ][ 2 ];
	}
	elseif ( !empty( $_GET[ 'file' ] ) )
	{
		$id = $_GET[ 'id' ];
	}
	else
	{
		$id = 0;
	}

	if ( !$id )
	{
		log_message( "office file convertion: no file id provided" );
		return false;
	}

	return $id;
}

function is_office_file( $file )
{
	return preg_match( '#\.docx?$|\.xlsx?$|\.pptx?$#', $file ) && file_exists( $file );
}

function files_path( $file )
{
	$realpath = str_replace( '/', '\\', "$file" );
	$pdf_filename = converted_filename( $realpath );

	return [
		$realpath,					// file_path
		$pdf_filename . '.tmp',		// tmp_path
		$pdf_filename,				// converted_path
	];
}

function converted_filename( $file )
{
	return preg_replace( '#\.docx?$|\.xlsx?$|\.pptx?$#', '.pdf', $file );
}

function convert_office_file_by_vbs( $file_path, $tmp_path, $converted_path )
{
	set_status( 'office转换中' );

	$command = "cscript /u /nologo " . ROOT . "\\file_converter\\convert-office-files.vbs";
	$arguments = $file_path;

	set_pid( getmypid() );
	set_startTS();

	exec( "$command \"$arguments\"", $output );

	set_pid( 0 );
	clear_startTS();

	$output_message = implode( ' ', $output );

	if ( false !== strpos( $output_message, '1 file converted' ) )
	{
		if ( @rename( $tmp_path, $converted_path ) )
		{
			set_status( 'office转换完成' );
			set_pdf_path( $converted_path );
			return true;
		}
		else
		{
			log_message( "can't move file: $tmp_path to $converted_path" );
			return false;
		}
	}

	set_status( 'office转换失败' );
	log_message( "convertion failed: message: " . mb_convert_encoding( $output_message, 'UTF-8', 'UTF-8, GBK' ) );
	return false;
}

function convert_office_file_by_exe( $file_path, $tmp_path, $converted_path )
{
	set_status( 'office转换中' );

	$command = ROOT . "\\file_converter\\OfficeToPDF";
	$arguments = "/readonly /print /hidden $file_path $converted_path";

	set_pid( getmypid() );
	set_startTS();

	exec( "$command $arguments", $output, $code );

	set_pid( 0 );
	clear_startTS();

	$output_message = implode( ' ', $output );

	if ( $code == 0 )
	{
		set_status( 'office转换完成' );
		set_pdf_path( $converted_path );
		return true;
	}

	set_status( 'office转换失败' );
	log_message( "convertion failed: code: $code message: " . mb_convert_encoding( $output_message, 'UTF-8', 'UTF-8, GBK' ) );
	return false;
}

function log_message( $message )
{
	file_put_contents( ROOT . '\\file_converter\\log.txt', $message . PHP_EOL, FILE_APPEND );

	error_log( $message );
}

function app()
{
	static $app = null;

	if ( !$app )
	{
		$app = new App();
	}

	return $app;
}

function set_status( $status )
{
	app()->db->exec( 'update file set status = ' . app()->db->quote( $status ) . " where id = " . $GLOBALS[ 'fid' ] );
}

function set_pdf_path( $path )
{
	$path = str_replace( [ ROOT, '\\' ], [ '', '/' ], $path );
	app()->db->exec( 'update file set pdfPath = ' . app()->db->quote( $path ) . " where id = " . $GLOBALS[ 'fid' ] );
}

function set_pid( $pid )
{
	app()->db->exec( 'update file set pid = ' . $pid . " where id = " . $GLOBALS[ 'fid' ] );
}

function set_startTS()
{
	app()->db->exec( 'update file set startTS = ' . time() . " where id = " . $GLOBALS[ 'fid' ] );
}

function clear_startTS()
{
	app()->db->exec( 'update file set startTS = ' . 0 . " where id = " . $GLOBALS[ 'fid' ] );
}

function psexec( $cmd )
{
	$psexec = "psexec -low -d -nobanner -accepteula $cmd";
	//echo $psexec;
	//my_shell_exec( $psexec );
	exec( $cmd );
}

function convert_pdf_to_images( $pdf_path )
{
	$image_dir = dirname( $pdf_path ) . "\\" . basename( $pdf_path, '.pdf' );
	$image_path = $image_dir . "\\%03d.jpg";
	$cmd = "magick -density 300 $pdf_path $image_path";

	@mkdir( $image_dir );

	set_pid( getmypid() );
	set_startTS();

	exec( $cmd, $output );

	set_pid( 0 );
	clear_startTS();

	$output_message = trim( implode( ' ', $output ) );

	if ( !$output_message )
	{
		set_status( 'pdf转换完成' );
		set_image_path( $image_dir );
		return true;
	}

	set_status( 'pdf转换失败' );
	log_message( "convertion failed: message: $output_message" );
	return false;
}

function set_image_path( $path )
{
	$path = str_replace( [ ROOT, '\\' ], [ '', '/' ], $path );
	app()->db->exec( 'update file set jpgPath = ' . app()->db->quote( $path ) . " where id = " . $GLOBALS[ 'fid' ] );
}

function my_shell_exec($cmd)
{
    $proc = proc_open($cmd,[
        1 => ['pipe','w'],
        2 => ['pipe','w'],
    ],$pipes);
    $stdout = stream_get_contents($pipes[1]);
	echo mb_convert_encoding($stdout, "UTF-8", "UTF-8, GBK");
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
	echo mb_convert_encoding($stderr, "UTF-8", "UTF-8, GBK");
    fclose($pipes[2]);
    return proc_close($proc);
}

function win_path( $path )
{
	return str_replace( '/', '\\', $path );
}