<?php

class News extends TableObject
{
	public $id				= 0;
	public $title			= '';
	public $cat				= 0;
	public $cat2			= 0;
	public $order			= 255;
	public $postDate		= '';
	public $read			= 0;
	public $content			= '';
	public $titleImage		= '';
	public $editor			= '';
	public $redirectUrl		= '';
	public $source			= '';
	public $summary			= '';
	public $status			= '已审核';
	public $video			= '';
	public $videoPoster		= '';
	public $pdf				= '';
	public $top				= 0;
	public $hide			= 0;


	public function read()
	{
		$this->db->exec( "update news set `read` = `read` + 1 where id = $this->id" );
	}

	public function getCatName()
	{
		$this->catName = $this->db->simpleQuery( "select name from news_cat where id = $this->cat", true, true );
	}

	public function hasVideo()
	{
		return (bool) $this->video;
	}

	public function output()
	{
		$out = parent::output();

		$out->titleImage = ltrim( $out->titleImage, '/' );
		$out->video = ltrim( $out->video, '/' );
		$out->videoPoster = ltrim( $out->videoPoster, '/' );
		$out->pdf = ltrim( $out->pdf, '/' );

		return $out;
	}
}

