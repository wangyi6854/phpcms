<?php

class MYSQL extends DB
{
	public function __construct( $dsn, $user, $password, $db_hint = '数据库', $driver_options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ) )
	{
		parent::__construct( $dsn, $user, $password, $db_hint, $driver_options );
	}

	public function queryPage( $table, $fields, $where, $order, $page, $pagesize, $get_page_count = false )
	{
		$start = ( $page - 1 ) * $pagesize;
		$query = "select $fields from `$table` $where $order limit $start, $pagesize";
		$data = $this->simpleQuery( $query );
		$total_records = $get_page_count ? intval( @$this->simpleQuery( "select count(*) as cnt from `$table` $where", true, true ) ) : 0;

		return array( $data, $total_records );
	}

	function queryPage2( $query, $page = 1, $pagesize = 20, $where = '', $table = '' )
	{
		$page = $page < 1 ? 1 : intval( $page );
		$offset = ( $page - 1 ) * $pagesize;

		$query .= " limit $offset, $pagesize";
		//$query = str_replace( 'sql_calc_found_rows', '', strtolower( $query ) );
		$result = $this->simpleQuery( $query );

		//list( $table, $where ) = parse_query( $query );
		//$num_result = intval( simple_query( "select count(*) from $table $where", true, true ) );
		if ( $where )
		{
			$num_result = intval( $this->simpleQuery( "select count(*) from $table $where", true, true ) );
		}
		else
		{
			$num_result = intval( $this->simpleQuery( "select found_rows()", true, true ) );
		}
		return array( $result, $num_result );
	}

	public function enumValues( $table, $column )
	{
		$enum = [];

		foreach ( $this->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'" ) as $row )
		{
			$type = $row[ 'Type' ];
			preg_match( "/^enum\(\'(.*)\'\)$/", $type, $matches );
			$enum = explode( "','", $matches[ 1 ] );

			break;
		}

		return $enum;
	}

	public function setValues( $table, $column )
	{
		$enum = [];

		foreach ( $this->query( "SHOW COLUMNS FROM {$table} LIKE '{$column}'" ) as $row )
		{
			$type = $row[ 'Type' ];
			preg_match( "/^set\(\'(.*)\'\)$/", $type, $matches );
			$enum = explode( "','", $matches[ 1 ] );

			break;
		}

		return $enum;
	}


}