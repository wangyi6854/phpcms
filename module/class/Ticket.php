<?php

class Ticket extends TableObject
{
	public $id				= 0;
	public $title			= '';
	public $address			= '';
    public $minAge		    = 0;
    public $maxAge		    = 0;
	public $sex		    	= '不限';
    public $count		    = 0;
    public $maxCount		= 40;
    public $start		    = '';
    public $applyStart		= '';
    public $applyEnd		= '';
    public $showStart		= '';
    public $showEnd	    	= '';
	public $content	    	= '';
	public $num 	    	= 1;
	public $image 	    	= '';

    public function __construct($data = null)
    {
        foreach ( [ 'applyStart', 'applyEnd', 'showStart', 'showEnd', ] as $key )
        {
                $this->$key = date('Y-m-d H:i:s', strtotime('19:00'));
        }
        parent::__construct($data);

    }
}

