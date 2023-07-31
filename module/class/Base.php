<?php
class Base
{
	protected DB $db;

	public function __construct()
	{
		if ( !defined( 'NODB' ) )
		{
			$this->initDB();
		}
	}

	public function initDB()
	{
		$this->db = DBInstance::getInstance();
	}

	function __sleep()
	{
		return array_diff( array_keys( get_class_vars( get_class( $this ) ) ), array( 'db' ) );
	}

	function __wakeup()
	{
	}

	public function showMessage( $message = '', $return_to = '' )
	{
		show_message( $message, $return_to );
	}

	public function showFriendlyMessage( $message = '', $return_to = '' )
	{
		global $extra_header, $extra_footer, $config;

		$page_title = '消息';

		$return_to = $return_to ?: $_SESSION[ 'return_to' ];

		if ( !empty( $_SESSION[ 'return_to' ] ) )
		{
			$_SESSION[ 'return_to' ] = '';
		}

		$timeout = 5;
		if ( $return_to && !defined( 'DEBUG' ) )
		{
			header( "Refresh: $timeout; url=$return_to" );
		}

		include ROOT . '/tpl/admin.message.php';
		exit();
	}

	public function getDataFromCache( $cacheKey, $data = null )
	{
		global $cache;

		if ( isset( $cache->$cacheKey ) )
		{
			$data = $cache->$cacheKey;
		}
		else
		{
			if ( !is_null( $data ) )
			{
				$cache->$cacheKey = $data;
			}
		}

		return $data;
	}

	public function getDBDataFromCache( $cacheKey, $query, $getFirstRow = false, $getFirstColumn = false )
	{
		if ( $data = $this->getDataFromCache( $cacheKey ) )
		{
			return $data;
		}

		if ( false !== ( $data = $this->db->simpleQuery( $query, $getFirstRow, $getFirstColumn ) ) )
		{
			global $cache;
			$cache->$cacheKey = $data;
		}

		return $data;
	}

	public function getDBPage2DataFromCache( $cache_key, $query, $page, $num = 1 )
	{
		if ( $data = $this->getDataFromCache( $cache_key ) )
		{
			return $data;
		}

		$data = $this->db->queryPage2( $query, $page, $num );
		if ( !empty( $data[ 0 ] ) )
		{
			global $cache;
			$cache->$cache_key = $data;
		}

		return $data;
	}

	public function enumValuesFromCache( $table, $column )
	{
		global $cache;

		$cache_key = "enum_{$table}_{$column}";

		if ( $cache->$cache_key )
		{
			return $cache->$cache_key;
		}

		$enum = $this->db->enumValues( $table, $column );

		$cache->$cache_key = $enum;

		return $enum;
	}

	public function setValuesFromCache( $table, $column )
	{
		global $cache;

		$cache_key = "set_{$table}_{$column}";

		if ( $cache->$cache_key )
		{
			return $cache->$cache_key;
		}

		$set = $this->db->setValues( $table, $column );

		$cache->$cache_key = $set;

		return $set;
	}

}