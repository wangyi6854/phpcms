<?php

class NewsCatList extends App
{
	public $list		= [];
	public $parentId	= -1;

	public function __construct( $parentId = -1 )
	{
		parent::__construct();

		$this->parentId = (int) $parentId;

		$where = $this->parentId == -1 ? '' : "where parentId = $this->parentId";

		foreach ( $this->getDBDataFromCache( "newsCatList_$parentId", "select * from news_cat $where order by parentId, id" ) as $entry )
		{
			$this->list[] = ( new NewsCat( $entry ) )->output();
		}
	}

	public function output()
	{
		$item					= new stdClass();

		$item->list				= $this->list;
		$item->parentId			= $this->parentId;

		return $item;
	}

}