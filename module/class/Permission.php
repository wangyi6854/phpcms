<?php

class Permission extends TableObject
{
	public $id				= 0;
	public $name			= '';

    public function __construct($data = null)
    {
        parent::__construct($data);

    }
}

