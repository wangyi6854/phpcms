<?php

class XCache extends Cache
{
	public static function available()
	{
		return function_exists( "xcache_get" );
	}

	public function __set( $key, $value )
	{
		$ttl = func_num_args() == 3 ? func_get_arg( 2 ) : $this->ttl;

		//debug( $this->storeKey( $key ) . "\t\t" . strlen( serialize( $value ) ) . "\t\t" . $ttl );
		return xcache_set( $this->storeKey( $key ), serialize( $value ), $ttl );
	}

	public function __get( $key )
	{
		return unserialize( xcache_get( $this->storeKey( $key ) ) );
	}

	public function __isset( $key )
	{
		return xcache_isset( $this->storeKey( $key ) );
	}

	public function __unset( $key )
	{
		return xcache_unset( $this->storeKey( $key ) );
	}

	public function info()
	{
		if ( func_num_args() )
		{
			$type = func_num_args() ? func_get_arg( 0 ) : null;
		}

		if ( $type && !in_array( $type, array( XC_TYPE_PHP, XC_TYPE_VAR ) ) )
		{
			throw new Exception( "wrong cache type.", E_USER_ERROR );
		}

		$cacheinfos = array();

		if ( !$type || $type == XC_TYPE_PHP )
		{
			$pcnt = xcache_count( XC_TYPE_PHP );

			$total = array();
			for ( $i = 0; $i < $pcnt; ++$i )
			{
				$data = xcache_info( XC_TYPE_PHP, $i );
				$data += xcache_list( XC_TYPE_PHP, $i );
				$data['type'] = XC_TYPE_PHP;
				$data['cache_name'] = "php#$i";
				$data['cacheid'] = $i;
				$cacheinfos[] = $data;
			}

			if ($pcnt >= 2)
			{
				$total['type'] = XC_TYPE_PHP;
				$total['cache_name'] = 'Total';
				$total['cacheid'] = $pcnt;
				$total['gc'] = null;
				$total['istotal'] = true;
				$cacheinfos[] = $total;
			}
		}

		if ( !$type || $type == XC_TYPE_VAR )
		{
			$vcnt = xcache_count( XC_TYPE_VAR );
			$total = array();
			for ( $i = 0; $i < $vcnt; ++$i )
			{
				$data = xcache_info( XC_TYPE_VAR, $i );
				$data += xcache_list( XC_TYPE_VAR, $i );
				$data['type'] = XC_TYPE_VAR;
				$data['cache_name'] = "var#$i";
				$data['cacheid'] = $i;
				$cacheinfos[] = $data;
			}

			if ( $vcnt >= 2 )
			{
				$total['type'] = XC_TYPE_VAR;
				$total['cache_name'] = 'Total';
				$total['cacheid'] = $vcnt;
				$total['gc'] = null;
				$total['istotal'] = true;
				$cacheinfos[] = $total;
			}
		}

		return $cacheinfos;
	}

	public function clear()
	{
		if ( func_num_args() )
		{
			$type = func_get_arg( 0 );
		}

		if ( func_num_args() > 1 )
		{
			$cacheid = func_get_arg( 1 );
		}

		if ( $type != XC_TYPE_PHP && $type != XC_TYPE_VAR )
		{
			return false;
		}

		$count = xcache_count( $type );
		if ( $cacheid == $count )
		{
			for ( $cacheid = 0; $cacheid < $count; ++$cacheid )
			{
				xcache_clear_cache( $type, $cacheid );
			}
		}
		else
		{
			xcache_clear_cache( $type, $cacheid );
		}

		return true;
	}

	public function unsetByPrefix( $prefix )
	{
		return xcache_unset_by_prefix( $this->storeKey( $prefix ) );
	}

	public function inc( $key, $value = 1 )
	{
		$ttl = func_num_args() == 3 ? func_get_arg( 2 ) : $this->ttl;
		return xcache_inc( $this->storeKey( $key ), $value, $ttl );
	}

	public function dec( $key, $value = 1 )
	{
		$ttl = func_num_args() == 3 ? func_get_arg( 2 ) : $this->ttl;
		return xcache_dec( $this->storeKey( $key ), $value, $ttl );
	}
}