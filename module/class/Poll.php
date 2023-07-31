<?php

class Poll extends TableObject
{
	public $id				= 0;
	public $title			= '';
	public $start		    = '';
	public $end 		    = '';
    public $showStart		= '';
    public $showEnd	    	= '';
	public $summary	    	= '';
	public $image	    	= '';

    public function __construct($data = null)
    {
        foreach ( [ 'start', 'end', 'showStart', 'showEnd', ] as $key )
        {
                $this->$key = date('Y-m-d H:i:s', strtotime('19:00'));
        }
        parent::__construct($data);
    }

}

