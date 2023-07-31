<?php
function upload_files( $input_name, $upload_dir, $type = '#\.(jpe?g|png|gif)$#i', $max_file_size = 4096000, $thumb_width = 0, $watermark = false, $max_photo_size = '' )
{
	$multi = false;
	if ( strpos( $input_name, '[' ) !== false )
	{
		$input_name = str_replace( array( '[', ']' ), '', $input_name );
		$multi = true;
	}

	$files = [];

	if ( $multi )
	{
		for ( $i = 0; $i < count( @$_FILES[ $input_name ]['error'] ); ++$i )
		{
			$fileinfo = [
				'name'		=> $_FILES[ $input_name ]['name'][ $i ],
				'type'		=> $_FILES[ $input_name ]['type'][ $i ],
				'size'		=> $_FILES[ $input_name ]['size'][ $i ],
				'tmp_name'	=> $_FILES[ $input_name ]['tmp_name'][ $i ],
				'error'		=> $_FILES[ $input_name ]['error'][ $i ],
			];
			if ( $file = upload_file( $fileinfo, $type, $max_file_size, $upload_dir, $thumb_width, $watermark, $max_photo_size ) )
			{
				$files[] = $file;
			}
		}
	}
	else
	{
		if ( $file = upload_file( $_FILES[ $input_name ], $type, $max_file_size, $upload_dir, $thumb_width, $watermark, $max_photo_size ) )
		{
			$files[] = $file;
		}
	}

	return $files;
}

function upload_file( $fileinfo, $type, $max_file_size, $upload_dir, $thumb_width, $watermark, $max_photo_size )
{
	$result = [
		'result'		=> false,
		'message'		=> '',
		'originalName'	=> $fileinfo['name'],
		'path'			=> '',
		'thumbnailPath'	=> '',
	];

	do
	{
		if ( $fileinfo['error'] == UPLOAD_ERR_NO_FILE )
		{
			return [];
			$result[ 'message' ] = '没有文件上传';
			break;;
		}

		if ( $result[ 'message' ] =	verify_uploaded_file(
					$fileinfo['error'],
					$fileinfo['name'],
					$fileinfo['tmp_name'],
					array(
						'type' => $type,
						'max_file_size' => $max_file_size
					)
				)
		)
		{
			break;
		}

		list( $dest, $result[ 'message' ], $thumb ) = add_uploaded_file( $fileinfo['name'], $fileinfo['tmp_name'], $upload_dir, $thumb_width, $watermark, $max_photo_size );
		if ( $result[ 'message' ] )
		{
			break;
		}

		$result[ 'path' ]			= $dest;
		$result[ 'thumbnailPath' ]	= $thumb;
		$result[ 'result' ]			= true;

	}
	while ( 0 );

	return $result;
}

function verify_uploaded_file( $error, $name, $tmp_name, $condition )
{
	// verify uploaded file.
	switch ( $error )
	{
		case UPLOAD_ERR_INI_SIZE:
			return "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。";
			break;
		case UPLOAD_ERR_FORM_SIZE:
			return "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。";
			break;
		case UPLOAD_ERR_PARTIAL:
			return "文件只有部分被上传。";
			break;
		case UPLOAD_ERR_NO_FILE:
			return "没有文件被上传。";
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			return "找不到临时文件夹。";
			break;
		case UPLOAD_ERR_CANT_WRITE:
			return "文件写入失败。";
			break;
		case UPLOAD_ERR_OK:
			break;
		default:
			return "未知错误。";
			break;
	}

	// verify file type.
	if ( array_key_exists( 'type', $condition ) )
	{
		if ( !preg_match( '#\.(jpe?g|png|docx?|xlsx?|pdf)$#i', $name ) )
		{
			return "禁止上传该类型文件";
		}
	}

	// examining file size.
	if ( array_key_exists( 'max_file_size', $condition ) && ( $max_file_size = $condition[ 'max_file_size' ] ) )
	{
		$size = filesize( $tmp_name );
		if ( !$size || $size > $max_file_size )
		{
			return "文件大小不能超过" . floor( $max_file_size / 1024 ) . "k。当前文件大小为" . ceil( $size / 1024 ) . "k。";
		}
	}

	return 0;
}

function add_uploaded_file( $name, $tmp_name, $uploaddir, $thumb_width = 0, $watermark = true, $max_photo_size = '' )
{
	global $config;

	$file = [];
	$dest = '';
	$error = '';
	$thumb = '';

	$uploaddir = ROOT . $uploaddir;

	if ( !file_exists( $uploaddir ) )
	{
		if ( !mkdir( $uploaddir, 0777, true ) )
		{
			return ( "建立目录错误，请检查服务器端设置。" );
		}
	}
	else if ( !is_dir( $uploaddir ) )
	{
		exit( "给定的目标目录是一个文件" );
	}

	$newname = generate_image_name( $name );

	$destination = rtrim( $uploaddir, '/' ) . '/' . $newname;

	if ( move_uploaded_file( $tmp_name, $destination ) )
	{
		$dest = str_replace( ROOT, '', $destination );
	}
	else
	{
		$error .= "移动上传文件出错。\n";
	}

	if ( !$error )
	{
		if ( $max_photo_size )
		{
			$resized_photo = resize_photo( $destination, $max_photo_size );
			unlink( $destination );
			$destination = $resized_photo;
			$dest = str_replace( ROOT, '', $destination );
		}

		if ( $thumb_width )
		{
			$thumb = createThumbs( $destination, $thumb_width );
			if ( !$thumb )
			{
				$thumb = $dest;
			}
		}

		if ( $watermark )
		{
			watermark( $destination );
		}
	}

	return array( $dest, $error, $thumb );
}

function createThumbs( $img, $thumbWidth = 150 )
{
	if ( !is_file( $img ) )
	{
		return '';
	}

	$img_gd = imagecreatefromfile( $img );

	$width = imagesx( $img_gd );
	$height = imagesy( $img_gd );

	if ( $width <= 300 )
	{
		//echo $width;
		imagedestroy( $img_gd );
		return '';
	}

	$new_width = $thumbWidth;
	$new_height = floor( $height * ( $thumbWidth / $width ) );

	$tmp_img = imagecreatetruecolor( $new_width, $new_height );

	if ( !imagecopyresized( $tmp_img, $img_gd, 0, 0, 0, 0, $new_width, $new_height, $width, $height ) )
	{
		//echo 'imagecopyresized';
	}

	$new_file_name = dirname( $img ) . '/' . generate_image_name( $img );

	if ( imagesave( $tmp_img, $new_file_name ) )
	{
		$thumb = str_replace( realpath( ROOT . '/../../' ), '', $new_file_name );
	}
	else
	{
		//echo "imagesave( $tmp_img, $new_file_name )";
		$thumb = '';
	}

	imagedestroy( $img_gd );
	imagedestroy( $tmp_img );

	return $thumb;
}

function watermark( $img, $watermark_file = '' )
{
	if ( !function_exists( 'imagecreatefrompng' ) )
	{
		echo 'gd must be enabled';
		return false;
	}

	$watermark_file = realpath( ROOT . '/../../' ) . ( $watermark_file ? $watermark_file : $GLOBALS['config']['watermark'] );

	if ( !is_writable( $img ) )
	{
		return false;
	}

	if ( !is_readable( $watermark_file ) )
	{
		return false;
	}

	$size = getimagesize( $img );

	if ( $size[0] <= 300 )
	{
		return '';
	}

	$watermark = imagecreatefrompng( $watermark_file );
	$watermark_width = imagesx( $watermark );
	$watermark_height = imagesy( $watermark );

	$dest_x = $size[0] - $watermark_width - 10;
	$dest_y = $size[1] - $watermark_height - 10;
	$image = imagecreatefromfile( $img, true );
	imagealphablending( $image, true );
	imagecopy( $image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height );
	imagealphablending($image, false);
	imagesavealpha($image, true);
	imagesave( $image, $img );
	imagedestroy( $image );
	imagedestroy( $watermark );
	return true;
}

function imagecreatefromfile($path, $user_functions = false)
{
    $info = @getimagesize($path);

    if(!$info)
    {
        return false;
    }

    $functions = array(
        IMAGETYPE_GIF => 'imagecreatefromgif',
        IMAGETYPE_JPEG => 'imagecreatefromjpeg',
        IMAGETYPE_PNG => 'imagecreatefrompng',
        IMAGETYPE_WBMP => 'imagecreatefromwbmp',
        IMAGETYPE_XBM => 'imagecreatefromwxbm',
        );

    if($user_functions)
    {
        $functions[IMAGETYPE_BMP] = 'imagecreatefrombmp';
    }

    if(!$functions[$info[2]])
    {
        return false;
    }

    if(!function_exists($functions[$info[2]]))
    {
        return false;
    }

    return $functions[$info[2]]($path);
}

function imagesave( $rs, $file, $user_functions = false )
{
	$tmp = explode( '.', $file );
	$ext = $tmp ? strtolower($tmp[count($tmp)-1]) : '';

	switch ( $ext )
	{
		case 'jpg':
		case 'jpeg':
			$function = 'imagejpeg';
			break;
		case 'gif':
			$function = 'imagegif';
			break;
		case 'png':
			$function = 'imagepng';
			break;
		case 'wbmp':
			$function = 'imagewbmp';
			break;
		case 'xbm':
			$function = 'imagewxbm';
			break;
		case 'bmp':
			if ( $user_functions )
			{
				$function = 'imagebmp';
			}
			break;
		default:
			return '';
	}

    if(!function_exists($function))
    {
        return false;
    }

	if ( $function == 'imagejpeg' )
	{
		return $function( $rs, $file, 90 );
	}

    return $function( $rs, $file );
}


/*********************************************/
/* Fonction: ImageCreateFromBMP              */
/* Author:   DHKold                          */
/* Contact:  admin@dhkold.com                */
/* Date:     The 15th of June 2005           */
/* Version:  2.0B                            */
/*********************************************/

if ( !function_exists( 'imagecreatefrombmp' ) )
{
	function imagecreatefrombmp($filename)
	{
	 //Ouverture du fichier en mode binaire
	   if (! $f1 = fopen($filename,"rb")) return FALSE;

	 //1 : Chargement des entêtes FICHIER
	   $FILE = unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));
	   if ($FILE['file_type'] != 19778) return FALSE;

	 //2 : Chargement des entêtes BMP
	   $BMP = unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
					 '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
					 '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));
	   $BMP['colors'] = pow(2,$BMP['bits_per_pixel']);
	   if ($BMP['size_bitmap'] == 0) $BMP['size_bitmap'] = $FILE['file_size'] - $FILE['bitmap_offset'];
	   $BMP['bytes_per_pixel'] = $BMP['bits_per_pixel']/8;
	   $BMP['bytes_per_pixel2'] = ceil($BMP['bytes_per_pixel']);
	   $BMP['decal'] = ($BMP['width']*$BMP['bytes_per_pixel']/4);
	   $BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);
	   $BMP['decal'] = 4-(4*$BMP['decal']);
	   if ($BMP['decal'] == 4) $BMP['decal'] = 0;

	 //3 : Chargement des couleurs de la palette
	   $PALETTE = array();
	   if ($BMP['colors'] < 16777216)
	   {
		$PALETTE = unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));
	   }

	 //4 : Création de l'image
	   $IMG = fread($f1,$BMP['size_bitmap']);
	   $VIDE = chr(0);

	   $res = imagecreatetruecolor($BMP['width'],$BMP['height']);
	   $P = 0;
	   $Y = $BMP['height']-1;
	   while ($Y >= 0)
	   {
		$X=0;
		while ($X < $BMP['width'])
		{
		 if ($BMP['bits_per_pixel'] == 24)
			$COLOR = unpack("V",substr($IMG,$P,3).$VIDE);
		 elseif ($BMP['bits_per_pixel'] == 16)
		 {
			$COLOR = unpack("n",substr($IMG,$P,2));
			$COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 8)
		 {
			$COLOR = unpack("n",$VIDE.substr($IMG,$P,1));
			$COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 4)
		 {
			$COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
			if (($P*2)%2 == 0) $COLOR[1] = ($COLOR[1] >> 4) ; else $COLOR[1] = ($COLOR[1] & 0x0F);
			$COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 1)
		 {
			$COLOR = unpack("n",$VIDE.substr($IMG,floor($P),1));
			if     (($P*8)%8 == 0) $COLOR[1] =  $COLOR[1]        >>7;
			elseif (($P*8)%8 == 1) $COLOR[1] = ($COLOR[1] & 0x40)>>6;
			elseif (($P*8)%8 == 2) $COLOR[1] = ($COLOR[1] & 0x20)>>5;
			elseif (($P*8)%8 == 3) $COLOR[1] = ($COLOR[1] & 0x10)>>4;
			elseif (($P*8)%8 == 4) $COLOR[1] = ($COLOR[1] & 0x8)>>3;
			elseif (($P*8)%8 == 5) $COLOR[1] = ($COLOR[1] & 0x4)>>2;
			elseif (($P*8)%8 == 6) $COLOR[1] = ($COLOR[1] & 0x2)>>1;
			elseif (($P*8)%8 == 7) $COLOR[1] = ($COLOR[1] & 0x1);
			$COLOR[1] = $PALETTE[$COLOR[1]+1];
		 }
		 else
			return FALSE;
		 imagesetpixel($res,$X,$Y,$COLOR[1]);
		 $X++;
		 $P += $BMP['bytes_per_pixel'];
		}
		$Y--;
		$P+=$BMP['decal'];
	   }

	 //Fermeture du fichier
	   fclose($f1);

	 return $res;
	}
}

function generate_image_name( $ext = '' )
{
	if ( $ext )
	{
		$tmp = explode( '.', $ext );
		$ext = $tmp ? '.' . $tmp[ count($tmp) - 1 ] : '';
	}

	return date("YmdHis") . "_" . md5( microtime() ) . $ext;
}

function resize_photo( $img, $max_photo_size )
{
	$size = explode( 'x', $max_photo_size );

	if ( !is_file( $img ) )
	{
		return '';
	}

	$img_gd = imagecreatefromfile( $img );

	$width = imagesx( $img_gd );
	$height = imagesy( $img_gd );

	$new_size = array( $width, $height );

	if ( $size[ 0 ] && $width > $size[ 0 ] )
	{
		$new_size = array( $size[ 0 ], $size[ 0 ] * $height / $width );
	}

	if ( $size[ 1 ] && $new_size[ 1 ] > $size[ 1 ] )
	{
		$new_size = array( $size[ 0 ] * $new_size[ 0 ] / $new_size[ 1 ], $size[ 1 ] );
	}

	$tmp_img = imagecreatetruecolor( $new_size[ 0 ], $new_size[ 1 ] );

	if ( !imagecopyresized( $tmp_img, $img_gd, 0, 0, 0, 0, $new_size[ 0 ], $new_size[ 1 ], $width, $height ) )
	{
		//echo 'imagecopyresized';
	}

	$new_file_name = dirname( $img ) . '/' . generate_image_name( $img );

	if ( imagesave( $tmp_img, $new_file_name ) )
	{
		$thumb = $new_file_name;
	}
	else
	{
		//echo "imagesave( $tmp_img, $new_file_name )";
		$thumb = '';
	}

	imagedestroy( $img_gd );
	imagedestroy( $tmp_img );

	return $thumb;
}