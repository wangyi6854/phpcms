<?php

class Schedule extends TableObject
{
	public $description		= '';
	public $submitStart		= '';
	public $submitEnd		= '';
	public $reviewStart		= '';
	public $reviewEnd		= '';
	public $review12Start	= '';
	public $review12End		= '';
	public $submit2Start	= '';
	public $submit2End		= '';
	public $review2Start	= '';
	public $review2End		= '';
	public $review22Start	= '';
	public $review22End		= '';

	public static function getCurrent()
	{
		global $app;

		$query = "select id from schedule where now() between submitStart and review22End order by id limit 1";
		if ( $data = $app->db->simpleQuery( $query, true, true ) )
		{
			return new Schedule( (int) $data );
		}

		return null;
	}

	public static function getLatestScheduleByTime( $time )
	{
		global $app;

		$query = "select id from schedule where submitStart >= " .  $app->db->quote( $time ) . " order by id limit 1";
		if ( $data = $app->db->simpleQuery( $query, true, true ) )
		{
			return (int) $data;
		}

		return null;
	}

	public static function getSchedulesByYear( $start, $end )
	{
		global $app;

		$query = "select id from schedule where submitStart between " .  $app->db->quote( $start ) . " and  " . $app->db->quote( $end ) . " order by id";
		if ( $data = $app->db->simpleQuery( $query ) )
		{
			$return = [];

			foreach ( $data as $row )
			{
				$return[] = (int) $row[ 'id' ];
			}

			return $return;
		}

		return null;
	}

	public function timeScope()
	{
		$now = time();

		if ( strtotime( $this->submitStart ) < $now && $now < strtotime( $this->submitEnd ) )
		{
			return [ $this->submitStart, $this->submitEnd ];
		}

		if ( strtotime( $this->reviewStart ) < $now && $now < strtotime( $this->reviewEnd ) )
		{
			return [ $this->reviewStart, $this->reviewEnd ];
		}

		if ( strtotime( $this->submit2Start ) < $now && $now < strtotime( $this->submit2Start ) )
		{
			return [ $this->submit2Start, $this->submit2Start ];
		}

		if ( strtotime( $this->review2Start ) < $now && $now < strtotime( $this->review2End ) )
		{
			return [ $this->review2Start, $this->review2End ];
		}

		return [];
	}

	public function save()
	{
		if ( $this->isStart() )
		{
			return false;
		}

		foreach ( array_keys( (array) $this ) as $p )
		{
			if ( str_endswith( $p, 'End' ) )
			{
				$this->$p = date( 'Y-m-d', strtotime( $this->$p ) ) . ' 23:59:59';
			}
		}

		$addNew = empty( $this->id );

		if ( parent::save() )
		{
			if ( $addNew )
			{
				$query = "insert into rel_schedule_rel_project_user select null, $this->id, id from rel_project_user where startTime <= " . $this->db->quote( $this->submitStart ) . " and endTime >= " . $this->db->quote( $this->review22End );
				return $this->db->simpleQuery( $query );
			}
			else
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}

	public function inSubmit()
	{
		return strtotime( $this->submitStart ) < time() && time() < strtotime( $this-> submitEnd );
	}

	public function inReview()
	{
		return strtotime( $this->reviewStart ) < time() && time() < strtotime( $this-> reviewEnd );
	}

	public function inReview12()
	{
		return strtotime( $this->review12Start ) < time() && time() < strtotime( $this-> review12End );
	}

	public function inSubmit2()
	{
		return strtotime( $this->submit2Start ) < time() && time() < strtotime( $this-> submit2End );
	}

	public function inReview2()
	{
		return strtotime( $this->review2Start ) < time() && time() < strtotime( $this-> review2End );
	}

	public function inReview22()
	{
		return strtotime( $this->review22Start ) < time() && time() < strtotime( $this-> review22End );
	}

	public function delete()
	{
		if ( !$this->id )
		{
			return false;
		}

		if ( $this->isStart() )
		{
			return false;
		}

		do
		{
			$this->db->beginTransaction();

			$this->db->exec( "delete from rel_schedule_rel_project_user where scheduleId = $this->id" );

			parent::delete();

			$this->db->commit();

			return true;
		}
		while ( 0 );
		{
			$this->db->rollBack();

			return false;
		}

	}

	public function isStart()
	{
		return strtotime( $this->submitStart ) <= time();
	}

}

