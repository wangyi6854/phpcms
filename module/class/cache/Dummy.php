<?php

class Dummy extends Cache
{
	public static function available()
	{
		return true;
	}

	public function __set( $key, $value )
	{
		return true;
	}

	public function __get( $key )
	{
		return null;
	}

	public function __isset( $key )
	{
		return false;
	}

	public function __unset( $key )
	{
		return true;
	}

	public function info()
	{
		return null;
	}

	public function clear()
	{
		return true;
	}

	public function inc( $key, $step = 1 )
	{
		return true;
	}

	public function dec( $key, $step = 1 )
	{
		return true;
	}
}