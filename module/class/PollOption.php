<?php

class PollOption extends TableObject
{
	public $id        = 0;
	public $pollId    = 0;
	public $optionCat = 0;
	public $type1     = '单位';
	public $type2     = '个人';
	public $street    = '';
	public $orgName   = '';
	public $title     = '';
	public $name      = '';
	public $phone     = '';
	public $image     = '';
	public $summary   = '';
	public $content   = '';
	public $count     = 0;
	public $status    = '未审核';

}

