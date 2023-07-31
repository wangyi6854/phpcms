<?php

class TableObject extends App
{
	public $id							= 0;

	protected $cacheKey					= '';
	protected $tableName				= '';
	protected $tableAvailableColumns	= [];
	protected $unpopulatedData			= [];
	protected $objectForSaving			= [];
	protected $notSavingColumns         = [];

	public function __construct( $data = null )
	{
		parent::__construct();

		$this->tableName = $this->tableName ?: $this->getTableName();

		if ( is_int( $data ) )
		{
			$this->id = $data;
			$this->cacheKey = $this->getCacheKey();
			$data = $this->getObj();
		}

		if ( is_array( $data ) )
		{
			$this->init( $data );
		}
		else
		{
			//throw new Exception( "Can't init class News with type: " . gettype( $data ), E_USER_ERROR );
		}
	}

	public function setNotSavingColumns( array $columns )
	{
		$this->notSavingColumns = $columns;
	}

	private function getTableName()
	{
		$tmp = explode( '\\', static::class );
		return decamelize( array_pop( $tmp ) );
	}

	private function getCacheKey()
	{
		return str_replace( '\\', '_', static::class ) . "_{$this->id}";
	}

	protected function getObj()
	{
		$query = "select * from $this->tableName where id = $this->id";

		return $this->getDBDataFromCache( $this->cacheKey, $query, true );
	}

	protected function init( $data )
	{
		foreach ( $data as $k => $d )
		{
			if ( property_exists( $this, $k ) )
			{
				switch ( $type = gettype( $this->$k ) )
				{
					case 'array':
						if ( gettype( $d ) == 'array' )
						{
							$this->$k = $d;
						}
						else
						{
							if ( $d )
							{
								$this->$k = explode( ',', $d );
							}
						}
						break;

					default :
						settype( $d, $type );
						$this->$k = $d;
				}
			}
			else
			{
				$this->unpopulatedData[] = [ $k => $d ];
			}
		}
	}

	public function output()
	{
		return $this;
	}

	public function save()
	{
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$result = false;

		try
		{
			$this->db->beginTransaction();

			if ( !$this->id )
			{
				$this->db->exec( "insert into `$this->tableName` ( id ) values ( null )" );

				$this->id = intval( $this->db->lastInsertId() );
			}

			$query = $this->buildUpdateQuery();

			$stmt = $this->db->prepare( $query );

			$this->prepareObjectForSaving();

			$this->bindUpdateValue( $stmt );

			$stmt->execute();

			$this->db->commit();

			$GLOBALS[ 'cache' ]->clear();

			$result = true;
		}
		catch ( PDOException $e )
		{
			debug( "DB Error: " . $e->getMessage() );
			$this->db->rollBack();
		}

		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

		return $result;
	}

	public function delete()
	{
		if ( $this->id )
		{
			$this->db->exec( "delete from `$this->tableName` where id = $this->id" );
		}
	}

	protected function buildUpdateQuery()
	{
		$this->getTableAvailableColumns();

		if ( !$this->tableAvailableColumns )
		{
			return '';
		}

		$query = "update `$this->tableName` set ";

		foreach ( $this->tableAvailableColumns as $c )
		{
			if ( in_array( $c, $this->notSavingColumns ) )
			{
				continue;
			}

			$query .= "`$c` = :$c, ";
		}

		$query = rtrim( $query, ', ' );

		$query .= " where id = :id";

		return $query;
	}

	protected function prepareObjectForSaving()
	{
	}

	protected function bindUpdateValue( $stmt )
	{
		foreach ( $this->tableAvailableColumns as $c )
		{
			$v = $this->prepareUpdateValue( $c );

			if ( is_array( $v ) )
			{
				$v = implode( ',', $v );
			}

			if ( !$stmt->bindValue( ":$c", $v ) )
			{
				error_log( "Can't bind $v to lable $c" );
			}
		}
	}

	protected function prepareUpdateValue( $key )
	{
		if ( array_key_exists( $key, $this->objectForSaving ) )
		{
			return $this->objectForSaving[ $key ];
		}

		return $this->$key;
	}

	protected function getTableAvailableColumns()
	{
		$result = [];

		$this_array = (array) $this;

		$db_name = $GLOBALS[ 'config' ][ 'db' ][ 'mysql_database' ];
		$query = "select column_name from information_schema.columns where table_schema = '$db_name' and table_name = '$this->tableName'";

		foreach ( $this->getDBDataFromCache( $this->cacheKey, $query ) as $row )
		{
			if ( array_key_exists( $row[ 'column_name' ], $this_array ) )
			{
				$result[] = $row[ 'column_name' ];
			}
		}

		return $this->tableAvailableColumns = $result;
	}
}

