<?php
class DBInstance
{
	private static $instance;

	private function __construct()
	{
	}

	public static function getInstance()
	{
		if ( !isset( self::$instance ) )
		{
			global $config;

			$class		= 'MYSQL';
			$db_hint	= '数据库';

			$host       = $config[ 'db' ][ 'mysql_host' ] ?? 'localhost';
			$port       = $config[ 'db' ][ 'mysql_port' ] ?? '3306';
			$dbname     = $config[ 'db' ][ 'mysql_database' ] ?? '';

			$dsn		= "mysql:host=$host;port=$port;dbname=$dbname";
			$user		= $config[ 'db' ][ 'mysql_user' ];
			$password	= $config[ 'db' ][ 'mysql_password' ];

			// clean up.
			//$config[ 'db' ][ 'mysql_host' ]		= '';
			//$config[ 'db' ][ 'mysql_database' ]	= '';
			//$config[ 'db' ][ 'mysql_user' ]		= '';
			//$config[ 'db' ][ 'mysql_password' ]	= '';

			require_once ROOT . "/module/class/DB/$class.php";
			self::$instance = new $class( $dsn, $user, $password, $db_hint );

		}

		return self::$instance;
	}

	public function __clone()
	{
		trigger_error( 'Clone is not allowed.', E_USER_ERROR );
	}

}

