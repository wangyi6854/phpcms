<?php

class APCu extends Cache
{
	public static function available()
	{
		return function_exists( "apcu_add" );
	}

	public function __set( $key, $value )
	{
		$ttl = func_num_args() == 3 ? func_get_arg( 2 ) : $this->ttl;

		//debug( $this->storeKey( $key ) . "\t\t" . strlen( serialize( $value ) ) . "\t\t" . $ttl );
		return apcu_store( $this->storeKey( $key ), serialize( $value ), $ttl );
	}

	public function __get( $key )
	{
		return unserialize( apcu_fetch( $this->storeKey( $key ) ) );
	}

	public function __isset( $key )
	{
		return apcu_exists( $this->storeKey( $key ) );
	}

	public function __unset( $key )
	{
		return apcu_delete( $this->storeKey( $key ) );
	}

	public function info()
	{
		return apcu_cache_info();
	}

	public function clear()
	{
		return apcu_clear_cache();
	}

	public function unsetByPrefix( $prefix )
	{
		foreach( new APCUIterator( '#^' . $this->storeKey( $prefix ) . '#' ) as $key )
		{
			apcu_delete( $key );
		}

		return true;
	}

	public function inc( $key, $step = 1 )
	{
		$ttl = func_num_args() == 3 ? func_get_arg( 2 ) : $this->ttl;
		return apcu_inc( $this->storeKey( $key ), $step, $ttl );
	}

	public function dec( $key, $step = 1 )
	{
		$ttl = func_num_args() == 3 ? func_get_arg( 2 ) : $this->ttl;
		return apcu_dec( $this->storeKey( $key ), $step, $ttl );
	}
}