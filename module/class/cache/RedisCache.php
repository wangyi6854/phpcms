<?php

class RedisCache extends Cache
{
	private $redis = null;

	public function __construct()
	{
		parent::__construct();

		global $config;

		$this->redis = new Redis();
		$this->redis->pconnect( $config[ 'redis' ][ 'host' ], $config[ 'redis' ][ 'port' ] );
		$this->redis->select( $config[ 'redis' ][ 'dbnumber' ] );
		$this->redis->setOption( Redis::OPT_PREFIX, $this->storeKeyPrefix );
		$this->redis->setOption( Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP );
	}

	public static function available()
	{
		return class_exists( "Redis" );
	}

	public function __set( $key, $value )
	{
		return $this->redis->set( $key, $value, $this->ttl );
	}

	public function __get( $key )
	{
		return $this->redis->get( $key );
	}

	public function __unset( $key )
	{
		return $this->redis->del( $key );
	}

	public function info()
	{
		return $this->redis->info();
	}

	public function clear()
	{
		return $this->redis->flushDb();
	}

	public function __isset( $key )
	{
		return $this->redis->exists( $key );
	}

	public function inc( $key, $step = 1 )
	{
		if ( $step == 1 )
		{
			return $this->redis->incr( $key );
		}
		else
		{
			return $this->redis->incrBy( $key, $step );
		}
	}

	public function dec( $key, $step = 1 )
	{
		if ( $step == 1 )
		{
			return $this->redis->decr( $key );
		}
		else
		{
			return $this->redis->decrBy( $key, $step );
		}
	}
}

