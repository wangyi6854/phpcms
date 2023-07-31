<?php

class User extends TableObject
{
	public $username		= '';
	public $password		= '';
	public $type			= 0;
	public $gid				= 0;
	public $status			= '';

	private const DEFAULT_PASSWORD = '111111';

	public function needChangePassword()
	{
		return false;
		if ( $this->password == self::DEFAULT_PASSWORD )
		{
			return true;
		}

		return false;
	}

	public static function getIdByUsername( $n )
	{
		global $app;

		$query = "select id from user where username = " . $app->db->quote( $n ) . " limit 1";

		if ( $id = (int) $app->db->simpleQuery( $query, true, true ) )
		{
			return $id;
		}
		else
		{
			$query = "insert into user ( username ) values ( " . $app->db->quote( $n ) . " )";
			if ( $id = (int) $app->db->simpleQuery( $query ) )
			{
				return $id;
			}
			else
			{
				throw new Exception( "user: $n" );
			}
		}
	}

	public function getOldPassword()
	{
		return $this->db->simpleQuery( "select password from user where id = $this->id", true, true );
	}

	public function validReviewStatusByGID()
	{
		switch ( $this->type )
		{
			case 0 :
				$status = [
				];

				break;


			case 2 :
				$status = [
				];

				break;

			case 1 :
				$status = [
				];

				break;

			default :
				$status = [];
		}

		return $status;
	}

}

