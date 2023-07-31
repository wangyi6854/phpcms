<?php

class PeopleList extends App
{
	public $page			= 0;
	public $startId			= 0;
	public $pageSize		= 20;
	public $totalRecords	= 0;
	public $hasNextRecord	= false;

	public $keyword;

	private $query;

	private $order			= 'id desc';
	private $cacheKey;
	private $noCalcTotal	= false;

	public $list			= [];

	public function __construct( $condition = array() )
	{
		parent::__construct();

		$this->initCondition( $condition );
		$this->getList();
	}

	public function getList()
	{
		if ( $this->query )
		{
			$data = $this->db->simpleQuery( $query );
		}
		else
		{
			if ( $this->keyword )
			{
				$GLOBALS[ 'config' ][ 'cache_enable' ] = false;
			}

			$parts = [];

			global $user;
			if ( $status = $user->validReviewStatusByGID() )
			{
				$parts[] = 'status in ( ' . $this->db->quoteArray( $status ) . ' )';
			}
			else
			{
				return [];
			}

			if ( is_numeric( $this->keyword ) )
			{
				$parts[] = 'id = ' . intval( $this->keyword );
				$start_time = $end_time = '';
			}
			else
			{
				$this->keyword ? $parts[] = 'title like ' . $this->db->quote( "%$this->keyword%" ) : null;
			}


			if ( $this->noCalcTotal )
			{
				$data = $this->getListByStartId( $parts );
			}
			else
			{
				$data = $this->getListByPage( $parts );
			}
		}

		foreach ( $data as $r )
		{
			$this->list[] = ( new People( $r ) )->output();
		}
	}

	public function getListByStartId( $parts )
	{
		$this->startId ? $parts[] = "id < $this->startId" : null;

		$where = $this->buildWhere( $parts );

		$size = $this->pageSize + 1;

		$query = "select * from people $where order by $this->order limit $size";

		$data = $this->getDBDataFromCache( $this->cacheKey, $query );

		if ( count( $data ) == $size )
		{
			$this->hasNextRecord = true;

			array_pop( $data );
		}

		return $data;
	}

	public function getListByPage( $parts )
	{
		$where = $this->buildWhere( $parts );

		$query = "select sql_calc_found_rows * from people $where order by $this->order";

		list( $data, $this->totalRecords ) = $this->getDBPage2DataFromCache( $this->cacheKey, $query, $this->page, $this->pageSize );

		return $data;
	}

	protected function buildWhere( $parts )
	{
		$t = implode( ' and ', $parts );

		/*
		if ( $this->cat2 )
		{
			if ( $t )
			{
				$t .= " or cat2 = $this->cat2";
			}
			else
			{
				$t = " cat2 = $this->cat2";
			}
		}
		*/

		return $t ? 'where ' . $t : '';
	}

	private function initCondition( $condition )
	{
		$this->keyword		= empty( $condition[ 'keyword' ] ) ? '' : $condition[ 'keyword' ];
		$this->page			= empty( $condition[ 'page' ] ) ? $this->page : (int) $condition[ 'page' ];
		$this->page			= $this->page < 1 ? 1 : $this->page;
		$this->pageSize		= empty( $condition[ 'pagesize' ] ) ? $this->pageSize : (int) $condition[ 'pagesize' ];
		$this->order		= isset( $condition[ 'order' ] ) ? $condition[ 'order' ] : $this->order;
		$this->query		= empty( $condition[ 'query' ] ) ? '' : $condition[ 'query' ];
		$this->noCalcTotal	= isset( $condition[ 'startId' ] ) ? true : false;

		$this->cacheKey = "newslist_{$this->page}_{$this->startId}_{$this->pageSize}" . md5( $this->order );
	}

	public function output()
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


