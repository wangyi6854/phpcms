<?php

function cxcache_set( $key, $value, $ttl = 600 )
{
	if ( !function_exists( "xcache_get" ) )
	{
		return false;
	}

	return xcache_set( $key, serialize( $value ), $ttl );
}

function cxcache_get( $key )
{
	if ( !function_exists( "xcache_get" ) )
	{
		return null;
	}

	return unserialize( xcache_get( $key ) );
}

function complete_url( $url )
{
	return strpos( $url, '://' ) === false ? '://' . $_SERVER[ 'SERVER_NAME' ] . $url : $url;
}

function external_host_prefix()
{
	if ( $_SERVER['SERVER_NAME'] == 'new.qdsnqwhg.cn')
	{
		return 'https://new.qdsnqwhg.cn:8002';
	}
	if ( $_SERVER['SERVER_NAME'] == 'www2.qdsnqwhg.cn')
	{
		return 'https://www2.qdsnqwhg.cn:58702';
	}

}