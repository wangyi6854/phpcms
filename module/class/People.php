<?php

class People extends TableObject
{
	public $id				= 0;
	public $name			= '';
	public $leixing			= [];
	public $jibie			= [];
	public $jingyan			= 0;
	public $age				= 0;
	public $neirong			= [];
	public $shuxiang		= '';
	public $jiguan			= '';
	public $jiangxiang		= '';
	public $quyu			= [];
	public $sex				= '女';
	public $company			= '';
	public $techang			= '';
	public $mobile			= '';
	public $photo			= [];
	public $idcard			= [];
	public $cert			= [];
	public $status			= '待审核';

	public function init( $data )
	{
		parent::init( $data );
	}

	public function getFiles()
	{
		foreach ( [ 'photo', 'idcard', 'cert' ] as $key )
		{
			$tmp = [];

			foreach ( $this->$key as $p )
			{
				if ( $p = (int) $p )
				{
					$tmp[] = new File( $p );
				}
			}

			$this->$key = $tmp;
		}
	}

	protected function prepareObjectForSaving()
	{
		foreach ( [ 'photo', 'idcard', 'cert' ] as $key )
		{
			$this->objectForSaving[ $key ] = [];

			foreach ( $this->$key as $p )
			{
				$this->objectForSaving[ $key ][] = $p->id;
			}
		}
	}

	public function review( $id, $pass, $comment )
	{
		if ( $pass )
		{
			switch ( $this->status )
			{
				// '待审核','初审中','初审通过','初审不通过','家协审核中','家协审核通过','家协审核不通过'
				case '待审核':
				case '初审中':
					$status = '初审通过';
					break;

				case '初审通过':
				case '家协审核中':
					$status = '家协审核通过';
					break;

				default :
					error_log( "错误状态：" . $this->status );
			}
		}
		else
		{
			switch ( $this->status )
			{
				// '待审核','初审中','初审通过','初审不通过','家协审核中','家协审核通过','家协审核不通过'
				case '待审核':
				case '初审中':
					$status = '初审不通过';
					break;

				case '初审通过':
				case '家协审核中':
					$status = '家协审核不通过';
					break;

				default :
					error_log( "错误状态：" . $this->status );
			}
		}

		global $app;

		return $app->addReview( $id, $status, $comment );
	}

	public function couldReview()
	{
		global $user;

		if ( in_array( $this->status, $user->validReviewStatusByGID() ) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}



