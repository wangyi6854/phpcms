<?php

class Cache
{
	public $ttl;
	protected $storeKeyPrefix;

	private static $instance;

	function __construct()
	{
		$this->ttl = $GLOBALS['config']['cache_ttl'];
		$this->storeKeyPrefix = 'SERVER_' .
            preg_replace('/\W/', '_', $_SERVER['SERVER_NAME'] ) .
            '_' .
            preg_replace( '/\W/', '_', HOME ) .
            '_'
        ;
	}

	public function __clone()
	{
		throw new Exception( "Object can't be cloned.", E_USER_ERROR );
	}

	final public static function singleton()
	{
		if ( !isset( self::$instance ) )
		{
			$order = array(
				'RedisCache',
				'XCache',
				'APCu',
				'Dummy',
			);

			if ( !$GLOBALS[ 'config' ][ 'cache_enable' ] )
			{
				array_unshift( $order, 'Dummy' );
			}

			foreach ( $order as $class )
			{
				if ( file_exists( __DIR__ . "/cache/$class.php" ) )
				{
					require_once __DIR__ . "/cache/$class.php";
					if ( $class::available() )
					{
						self::$instance = new $class;
						break;
					}
				}
			}
		}

		return self::$instance;
	}


	protected function storeKey( $key )
	{
		return $this->storeKeyPrefix . $key;
	}
}

