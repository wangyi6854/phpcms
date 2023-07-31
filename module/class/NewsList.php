<?php

class NewsList extends App
{
	public $page			= 0;
	public $startId			= 0;
	public $pageSize		= 20;
	public $totalRecords	= 0;
	public $hasNextRecord	= false;

	public $cat;
	public $cat2;
	public $catName;
	public $cat2Name;
	public $subCat;
	public $subCatName;
	public $keyword;
	public $startTime;
	public $endTime;
	public $top				= -1;

	private $query;

	private $getImageNews	= false;
	private $singleCat		= false;
	private $order			= '`order`, id desc';
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
			if ( $this->keyword || $this->startTime || $this->endTime )
			{
				$GLOBALS[ 'config' ][ 'cache_enable' ] = false;
			}

			$parts = [];

			if ( $this->singleCat )
			{
				$this->cat ? $parts[] = "cat = $this->cat" : null;
				$this->cat2 ? $parts[] = "cat2 = $this->cat2" : null;
			}
			else
			{
				$this->cat ? $parts[] = "( cat = $this->cat or cat2 = $this->cat2 )" : null;
			}
			$this->subCat ? $parts[] = "subcat = $this->subCat" : null;

			$this->top != -1 ? $parts[] = "top = $this->top" : null;

			if ( is_numeric( $this->keyword ) )
			{
				$parts[] = 'id = ' . intval( $this->keyword );
				$start_time = $end_time = '';
			}
			else
			{
				$this->keyword ? $parts[] = 'title like ' . $this->db->quote( "%$this->keyword%" ) : null;
			}
			$this->getImageNews ? $parts[] = "title_image != ''" : null;

			$start_time = $this->startTime ? date( 'Y-m-d H:i:s', $this->startTime ) : '';
			$end_time = $this->endTime ? date( 'Y-m-d H:i:s', $this->endTime ) : '';
			$start_time ? $parts[] = 'postdate >= ' . $this->db->quote( $start_time ) : '';
			$end_time ? $parts[] = 'postdate <= ' . $this->db->quote( $end_time ) : '';

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
			$this->list[] = ( new News( $r ) )->output();
		}
	}

	public function getListByStartId( $parts )
	{
		$this->startId ? $parts[] = "id < $this->startId" : null;

		$where = $this->buildWhere( $parts );

		$size = $this->pageSize + 1;

		$query = "select * from news $where order by $this->order limit $size";

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

		$query = "select sql_calc_found_rows * from news $where order by $this->order";

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
		$this->cat			= empty( $condition[ 'cat' ] ) ? 0 : (int) $condition[ 'cat' ];
		$this->cat2			= empty( $condition[ 'cat2' ] ) ? 0 : (int) $condition[ 'cat2' ];
		$this->subCat		= empty( $condition[ 'subcat' ] ) ? 0 : (int) $condition[ 'subcat' ];
		$this->keyword		= empty( $condition[ 'keyword' ] ) ? '' : $condition[ 'keyword' ];
		$this->startTime	= empty( $condition[ 'start_time' ] ) ? 0 : strtotime( $condition[ 'start_time' ] );
		$this->endTime		= empty( $condition[ 'end_time' ] ) ? 0 : strtotime( $condition[ 'end_time' ] );
		$this->startId		= empty( $condition[ 'startId' ] ) ? $this->startId : (int) $condition[ 'startId' ];
		$this->top			= !isset( $condition[ 'top' ] ) ? $this->top : (int) $condition[ 'top' ];
		$this->page			= empty( $condition[ 'page' ] ) ? $this->page : (int) $condition[ 'page' ];
		$this->page			= $this->page < 1 ? 1 : $this->page;
		$this->pageSize		= empty( $condition[ 'pagesize' ] ) ? $this->pageSize : (int) $condition[ 'pagesize' ];
		$this->getImageNews	= empty( $condition[ 'image' ] ) ? false : true;
		$this->order		= isset( $condition[ 'order' ] ) ? $condition[ 'order' ] : $this->order;
		$this->query		= empty( $condition[ 'query' ] ) ? '' : $condition[ 'query' ];
		$this->noCalcTotal	= isset( $condition[ 'startId' ] ) ? true : false;
		$this->singleCat	= empty( $condition[ 'singleCat' ] ) ? false : true;

		$this->cacheKey = "newslist_{$this->cat}_{$this->cat2}_{$this->subCat}_{$this->page}_{$this->startId}_{$this->pageSize}_{$this->getImageNews}_{$this->singleCat}_{$this->top}" . md5( $this->order );
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


