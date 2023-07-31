<?php

abstract class DB extends PDO
{
	public $lastQuery		= '';
	public $queryStart		= 0;
	protected $dbHint		= '数据库';

	public function __construct( $dsn, $user, $password, $db_hint = '数据库', $driver_options = array() )
	{
		$this->dbHint = $db_hint;

		try
		{
			parent::__construct(
				$dsn,
				$user,
				$password,
				$driver_options
			);

			parent::setAttribute( PDO::ATTR_STATEMENT_CLASS, array(
					'DBStatement',
					array(
						$this
					)
				)
			);
		}
		catch( PDOException $e )
		{
			throw new Exception( "无法连接" . $e->getMessage(), E_USER_ERROR );
		}
	}

	public function exec( $query ):int
	{
		global $config;

		$this->lastQuery = trim( $query );

		debug( [
			'query'		=> $this->lastQuery,
		], 'querys' );

		$this->queryStart = microtime(true);

		$result = parent::exec( $this->lastQuery );

		$time = timediff( $this->queryStart );

		debug( [
			'query_time'		=> $time,
			'errorInfo'	=> $this->errorInfo(),
		], 'querys' );

		if ( $this->errorCode() != '00000' )
		{
			error_log( "query: $this->lastQuery" . PHP_EOL . "info: " . var_export( $this->errorInfo(), true ) );
		}

		return $result;
	}

	public function query( $query, $fetch_style = PDO::FETCH_ASSOC, mixed ...$fetch_mode_args ):PDOStatement
	{
		global $config;

		$this->lastQuery = trim( $query );

		debug( [
			'query'		=> $this->lastQuery,
		], 'querys' );

		$this->queryStart = microtime(true);

		$result = parent::query( $this->lastQuery, $fetch_style );

		$time = timediff( $this->queryStart );

		debug( [
			'query_time'		=> $time,
			'errorInfo'	=> $this->errorInfo(),
		], 'querys' );

		if ( $this->errorCode() != '00000' )
		{
			error_log( "query: $this->lastQuery" . PHP_EOL . "info: " . var_export( $this->errorInfo(), true ) );
		}

		return $result;
	}

	public function simpleQuery( $query, $first_row = false, $first_column = false, $fetch_style = PDO::FETCH_ASSOC ) : mixed
	{
		$data = array();

		$fetch_style = $first_column ? PDO::FETCH_NUM : $fetch_style;
		if ( !$result = $this->query( $query, $fetch_style ) )
		{
			return false;
		}

		if ( $this->isInsert() )
		{
			return $this->lastInsertId();
		}

		if ( $this->isSelect() )
		{
			$data = $result->fetchAll( $fetch_style );

			if ( $first_column )
			{
				return empty( $data[ 0 ][ 0 ] ) ? '' : $data[ 0 ][ 0 ];
			}

			if ( $first_row )
			{
				return empty( $data[ 0 ] ) ? '' : $data[ 0 ];
			}
		}
		else
		{
			return $result;
		}

		return $data;
	}

	abstract public function queryPage( $table, $fields, $where, $order, $page, $pagesize, $get_page_count = false );
	abstract public function queryPage2( $query, $page = 1, $pagesize = 10, $where = '', $table = '' );

	public function prepare( $statement, $driver_options = array() ): PDOStatement
	{
		$this->lastQuery = trim( $statement );

		debug( [
			'query'		=> $this->lastQuery,
		], 'querys' );

		$this->queryStart = microtime(true);

		return parent::prepare( $statement );
	}

	public function quoteArray( $array )
	{
		return implode( ', ', array_map( array( $this, 'quote' ), $array ) );
	}

	public function isInsert()
	{
		return stripos( $this->lastQuery, 'insert' ) === 0 ? true : false;
	}

	public function isSelect()
	{
		return stripos( $this->lastQuery, 'select' ) === 0 ? true : false;
	}

	abstract public function enumValues( $table, $column );
}

class DBStatement extends PDOStatement
{
	public $db;

	protected function __construct( $db )
	{
		$this->db = $db;
	}

	public function execute( $input_parameters = null ): bool
	{
		$result = parent::execute( $input_parameters );

		$time = timediff( $this->db->queryStart );

		debug( [
			'query_time'		=> $time,
			'errorInfo'	=> $this->errorInfo(),
		], 'querys' );

		if ( $this->errorCode() != '00000' )
		{
			error_log(
				"query: " . $this->db->lastQuery . PHP_EOL .
				"parameters: " . $this->debugDumpParams() . PHP_EOL .
				"info: " . var_export( $this->errorInfo()
			, true ) );
		}

		return $result;
	}

	public function debugDumpParams(): ?bool
	{
		ob_start();
		parent::debugDumpParams();
		return ob_get_clean();
	}
}

class DBError extends PDOException
{

}













