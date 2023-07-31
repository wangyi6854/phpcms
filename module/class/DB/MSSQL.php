<?php

class MSSQL extends DB
{
	public function __construct( $dsn, $user, $password, $db_hint = '数据库', $driver_options = array() )
	{
		parent::__construct( $dsn, $user, $password, $db_hint, $driver_options );
	}

	public function queryPage( $table, $fields, $where, $order, $page, $pagesize, $get_page_count = false )
	{
		/*
		if ( $page == 1 )
		{
			$data = $this->simpleQuery( "select top $pagesize $fields from [$table] $where $order" );
			$total_records = $get_page_count ? intval( @$this->simpleQuery( "select count(*) as cnt from [$table] $where", true, true ) ) : 0;
		}
		else
		{
		*/
			$start = ( $page - 1 ) * $pagesize + 1;
			$end = $start + $pagesize - 1;
			$page_count = $get_page_count ? "total_records = count(*) over()," : '';

			$data =	$this->simpleQuery(
				"with t as
				(
					select $fields,
					$page_count
					row_number() over ( $order ) as 'row_number'
					from [$table] with (NOLOCK)
					$where
				)
				select *
				from t
				where row_number between $start and $end"
			);
			$total_records = $get_page_count ? ( empty( $data[ 0 ][ 'total_records' ] ) ? 0 : intval( $data[ 0 ][ 'total_records' ] ) ) : 0;
		//}

		return array( $data, $total_records );
	}

	public function isSelect()
	{
		return stripos( $this->lastQuery, 'select' ) === 0 || stripos( $this->lastQuery, 'with' ) === 0 ? true : false;
	}

	public function lastInsertId( $name = 'insert_id' )
	{
		return $this->simpleQuery( "select @@IDENTITY as $name", true, true );
	}
}