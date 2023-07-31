<?php

class File extends TableObject
{
	public $id				= 0;
	public $name			= '';
	public $description		= '';
	public $path			= '';
	public $pdfPath			= '';
	public $jpgPath			= '';
	public $uploadDate		= '';
	public $size			= 0;
	public $type			= '';

	public $images			= [];

	public $url				= '';

	public function __construct( $data = null )
	{
		parent::__construct( $data );

		if ( !$this->fileExists() )
		{
			return false;
		}

		$this->getFileSize();
		$this->getFileType();

		$this->genUrl();
		$this->fillPdfPath();
	}

	protected function fileExists()
	{
		if ( rtrim( $this->path, '/\\' ) )
		{
			$realpath = realpath( ROOT . $this->path );

			if ( strpos( $realpath, ROOT ) === 0 )
			{
				return file_exists( $realpath );
			}
		}

		return false;
	}

	protected function getFileSize()
	{
		$this->size = filesize( ROOT . $this->path );
	}

	protected function getFileType()
	{
		if ( preg_match( '/pdf/i', $this->path ) )
		{
			$this->type = 'pdf';
		}
		elseif ( preg_match( '/jpe?g|png/i', $this->path ) )
		{
			$this->type = 'image';
		}
		elseif ( preg_match( '/docx?/i', $this->path ) )
		{
			$this->type = 'doc';
		}
		elseif ( preg_match( '/xlsx?/i', $this->path ) )
		{
			$this->type = 'xls';
		}
		else
		{
		}
	}

	protected function genUrl()
	{
		$this->url = '://' . $_SERVER[ 'SERVER_NAME' ] . $this->path;
	}

	protected function fillPdfPath()
	{
		if ( !$this->pdfPath && $this->type == 'pdf' )
		{
			$this->pdfPath = $this->path;
		}
	}

	public function getImages()
	{
		if ( $this->jpgPath )
		{
			$array = glob( ROOT . $this->jpgPath . "\\*.jpg" );
			array_walk( $array, function ( &$value, $key ) {
				$value = str_replace( ROOT, '', $value );
			} );

			$this->images = $array;
		}
		elseif ( $this->type == 'image' )
		{
			$this->images[] = $this->path;
		}
	}
}

