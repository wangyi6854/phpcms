<?php

class Submission extends TableObject
{
	public $files			= '';
	public $status			= '未填报';
	public $relScheduleRelProjectUserId	= 0;
	public $relProjectUserId			= 0;
	public $scheduleId		= 0;
	public $projectId		= 0;
	public $submitter		= 0;
	public $reviewer		= 0;
	public $finalReviewer	= 0;
	public $submitTime		= '';
	public $reviewTime		= '';
	public $review12Time	= '';
	public $submit2Time		= '';
	public $review2Time		= '';
	public $review22Time	= '';
	public $memo			= '';
	public $reviewMemo		= '';

	private $originalStatus	= '未填报';

	private $savedTime		= [];

	private static $statusEnum = [
		'未填报',
		'待审',
		'二级初审通过',
		'二级初审不通过',
		'一级初审通过',
		'一级初审不通过',
		'二次待审',
		'二级复审通过',
		'二级复审不通过',
		'一级复审通过',
		'一级复审不通过',
		'通过',
		'不通过',
	];

	public function init( $data )
	{
		if ( !empty( $data[ 'id' ] ) )
		{
			$this->originalStatus = $this->getOriginalStatus( $data[ 'id' ] );
		}

		if ( is_int( $data ) && $data )
		{
			$this->originalStatus = $this->getOriginalStatus( $data );
		}

		parent::init( $data );

		$this->getRelProjectUserIdAndScheduleId();
		$this->getProjectIdAndUserId();
	}

	public function save()
	{
		if ( in_array( $this->originalStatus, [ '通过', '未通过' ] ) )
		{
			return false;
		}

		if ( !$this->saveble() )
		{
			//return false;
			$this->showFriendlyMessage( "目前不可提交" );
		}

		$this->genStatus();

		unset( $this->reviewMemo );

		$this->saveTime();

		$result = parent::save();

		$this->updateTime();

		return $result;
	}

	private function saveble()
	{
		if ( $_SESSION[ 'type' ] == 0 )
		{
			return true;
		}

		if ( $this->submitter && $this->submitter != $_SESSION[ 'uid' ] )
		{
			return false;
		}

		$schedule = Schedule::getCurrent();

		return $schedule->inSubmit() || $schedule->inSubmit2();
	}

	private function getRelProjectUserIdAndScheduleId()
	{
		$result = $this->db->simpleQuery( "select relProjectUserId, scheduleId from rel_schedule_rel_project_user where id = $this->relScheduleRelProjectUserId", true  );

		$this->relProjectUserId = (int) $result[ 'relProjectUserId' ];
		$this->scheduleId = (int) $result[ 'scheduleId' ];
	}

	private function getProjectIdAndUserId()
	{
		$result = $this->db->simpleQuery( "select * from rel_project_user where id = $this->relProjectUserId", true  );

		$this->projectId = (int) $result[ 'projectId' ];
		$this->submitter = (int) $result[ 'submitter' ];
		$this->reviewer = (int) $result[ 'reviewer' ];
		$this->finalReviewer = (int) $result[ 'finalReviewer' ];
	}

	private function getOriginalStatus( $id )
	{
		return $this->db->simpleQuery( "select status from submission where id = " . $this->db->quote( $id ), true, true );
	}

	private function genStatus()
	{
		$this->status = $this->originalStatus;

		global $now;

		$schedule = Schedule::getCurrent();

		if ( $schedule->inSubmit() )
		{
			if ( in_array( $this->originalStatus, [ '未填报', '待审' ] ) )
			{
				$this->status = '待审';
				$this->submitTime = $now;
			}
		}
		elseif ( $schedule->inReview() )
		{
		}
		elseif ( $schedule->inReview12() )
		{
		}
		elseif ( $schedule->inSubmit2() )
		{
			if ( in_array( $this->originalStatus, [ '二级初审不通过', '一级初审不通过' ] ) )
			{
				$this->status = '二次待审';
				$this->submit2Time = $now;
			}
		}
		elseif ( $schedule->inReview2() )
		{
		}
		elseif ( $schedule->inReview22() )
		{
		}
		else
		{
		}
	}

	public function pass( $pass, $reviewMemo )
	{
		global $now;

		$query = "select reviewer, finalReviewer from rel_project_user where id = $this->relProjectUserId";
		$result = $this->db->simpleQuery( $query, true );

		$final_review = $result[ 'reviewer' ] == $result[ 'finalReviewer' ];


		$schedule = Schedule::getCurrent();


		if ( $schedule->inSubmit() )
		{
		}
		elseif ( $schedule->inReview() )
		{
			if ( $final_review )
			{
				if ( $pass )
				{
					$this->status = '通过';
					$this->reviewTime = $now;
					$this->review12Time = $now;
					$this->review2Time = $now;
					$this->review22Time = $now;
				}
				else
				{
					$this->status = '一级初审不通过';
					$this->reviewTime = $now;
					$this->review12Time = $now;
				}
			}
			else
			{
				if ( $pass )
				{
					$this->status = '二级初审通过';
					$this->reviewTime = $now;
				}
				else
				{
					$this->status = '二级初审不通过';
					$this->reviewTime = $now;
				}
			}

		}
		elseif ( $schedule->inReview12() )
		{
			if ( $pass )
			{
				$this->status = '通过';
				$this->review12Time = $now;
				$this->review2Time = $now;
				$this->review22Time = $now;
			}
			else
			{
				$this->status = '一级初审不通过';
				$this->review12Time = $now;
			}
		}
		elseif ( $schedule->inSubmit2() )
		{
		}
		elseif ( $schedule->inReview2() )
		{
			if ( $final_review )
			{
				if ( $pass )
				{
					$this->status = '通过';
					$this->review2Time = $now;
					$this->review22Time = $now;
				}
				else
				{
					$this->status = '一级复审不通过';
					$this->reviewTime = $now;
					$this->review12Time = $now;
				}
			}
			else
			{
				if ( $pass )
				{
					$this->status = '二级复审通过';
					$this->review2Time = $now;
				}
				else
				{
					$this->status = '二级复审不通过';
					$this->review2Time = $now;
				}
			}
		}
		elseif ( $schedule->inReview22() )
		{
			if ( $pass )
			{
				$this->status = '通过';
				$this->review22Time = $now;
			}
			else
			{
				$this->status = '不通过';
				$this->review22Time = $now;
			}
		}
		else
		{
			return false;
		}


		$this->saveTime();
		$this->updateTime();

		$reviewMemoPart = $reviewMemo ? ', reviewMemo = ' . $this->db->quote( $reviewMemo ) : '';
		$this->db->exec( "update $this->tableName set status = '$this->status' $reviewMemoPart where id = $this->id" );

		return true;
	}

	protected function saveTime()
	{
		$this->savedTime = [
			$this->submitTime,
			$this->reviewTime,
			$this->review12Time,
			$this->submit2Time,
			$this->review2Time,
			$this->review22Time,
		];

		unset( $this->submitTime );
		unset( $this->reviewTime );
		unset( $this->review12Time );
		unset( $this->submit2Time );
		unset( $this->review2Time );
		unset( $this->review22Time );
	}

	protected function updateTime()
	{
		@list(
			$this->submitTime,
			$this->reviewTime,
			$this->review12Time,
			$this->submit2Time,
			$this->review2Time,
			$this->review22Time
		) = $this->savedTime;

		if ( $this->submitTime )
		{
			$this->db->exec( "update $this->tableName set submitTime = " . $this->db->quote( $this->submitTime ) . " where id = $this->id" );
		}

		if ( $this->reviewTime )
		{
			$this->db->exec( "update $this->tableName set reviewTime = " . $this->db->quote( $this->reviewTime ) . " where id = $this->id" );
		}

		if ( $this->review12Time )
		{
			$this->db->exec( "update $this->tableName set review12Time = " . $this->db->quote( $this->review12Time ) . " where id = $this->id" );
		}

		if ( $this->submit2Time )
		{
			$this->db->exec( "update $this->tableName set submit2Time = " . $this->db->quote( $this->submit2Time ) . " where id = $this->id" );
		}

		if ( $this->review2Time )
		{
			$this->db->exec( "update $this->tableName set review2Time = " . $this->db->quote( $this->review2Time ) . " where id = $this->id" );
		}

		if ( $this->review22Time )
		{
			$this->db->exec( "update $this->tableName set review22Time = " . $this->db->quote( $this->review22Time ) . " where id = $this->id" );
		}

	}

	public function isMine()
	{
		return $this->submitter == $_SESSION[ 'uid' ];
	}
}

