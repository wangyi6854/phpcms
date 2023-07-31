<?php

class TableObjectList extends App
{
	public $page			= 0;
	public $startId			= 0;
	public $pageSize		= 20;
	public $totalRecords	= 0;
	public $hasNextRecord	= false;

    private $query			= '';
    private $parts			= [];

	protected $tableName		= '';

	private $order			= 'id desc';
	private $cacheKey		= '';
	private $noCalcTotal	= false;

	public $list			= [];

	public $conditions		= [];

	public function __construct( $condition = array() )
	{
		parent::__construct();

		$this->tableName = $this->tableName ?: $this->getTableName();

		$this->initCondition( $condition );
		$this->getList();
	}

	private function getTableName()
	{
		$tmp = explode( '\\', static::class );
		return preg_replace( '#(.*?)_list$#', '$1', decamelize( array_pop( $tmp ) ) );
	}

   	public function getList()
	{
		if ( $this->query )
		{
			$data = $this->db->simpleQuery( $this->query );
		}
		else
		{
			if ( $this->noCalcTotal )
			{
				$data = $this->getListByStartId();
			}
			else
			{
				$data = $this->getListByPage();
			}
		}

		foreach ( $data as $r )
		{
            $objName = str_replace( 'List', '', static::class );
			$this->list[] = new $objName( $r );
		}
	}

	public function getListByStartId()
	{
		$this->startId ? $this->parts[] = "id < $this->startId" : null;

		$where = $this->buildWhere();

		$size = $this->pageSize + 1;

		$query = "select * from `" . $this->tableName . "` $where order by $this->order limit $size";

		$data = $this->getDBDataFromCache( $this->cacheKey, $query );

		if ( count( $data ) == $size )
		{
			$this->hasNextRecord = true;

			array_pop( $data );
		}

		return $data;
	}

	public function getListByPage()
	{
		$where = $this->buildWhere();

		$query = "select sql_calc_found_rows * from `" . $this->tableName . "` $where order by $this->order";

		list( $data, $this->totalRecords ) = $this->getDBPage2DataFromCache( $this->cacheKey, $query, $this->page, $this->pageSize );

		return $data;
	}

	protected function buildWhere()
	{
		$t = implode( ' and ', $this->parts );

		return $t ? 'where ' . $t : '';
	}

	private function initCondition( $condition )
	{
		$this->startId		= empty( $condition[ 'startId' ] ) ? $this->startId : (int) $condition[ 'startId' ];
		$this->page			= empty( $condition[ 'page' ] ) ? $this->page : (int) $condition[ 'page' ];
		$this->page			= $this->page < 1 ? 1 : $this->page;
		$this->pageSize		= empty( $condition[ 'pagesize' ] ) ? $this->pageSize : (int) $condition[ 'pagesize' ];
		$this->order		= isset( $condition[ 'order' ] ) ? $condition[ 'order' ] : $this->order;
        $this->query		= empty( $condition[ 'query' ] ) ? '' : $condition[ 'query' ];
        $this->parts		= empty( $condition[ 'parts' ] ) ? [] : $condition[ 'parts' ];
		$this->noCalcTotal	= isset( $condition[ 'startId' ] ) ? true : false;

		$this->cacheKey		= $condition[ 'cacheKey' ] ?? $this->tableName . '_{$this->startId}_{$this->page}_{$this->pageSize}_' . md5( $this->order );
	}

    public function output() : stdClass
    {
        $item				= new stdClass();

        $item->page			= $this->page;
        $item->startId		= $this->startId;
        $item->pageSize		= $this->pageSize;
        $item->totalRecords	= $this->totalRecords;
        $item->list			= $this->list;

        return $item;
    }
}


