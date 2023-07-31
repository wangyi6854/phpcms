<?php

class Requirement extends TableObject
{
	public $content		= '';

	public static function getIdByContent( $c )
	{
		global $app;

		$query = "select id from requirement where content = " . $app->db->quote( $c ) . " limit 1";

		if ( $id = (int) $app->db->simpleQuery( $query, true, true ) )
		{
			return $id;
		}
		else
		{
			$query = "insert into requirement ( content ) values ( " . $app->db->quote( $c ) . " )";
			if ( $id = (int) $app->db->simpleQuery( $query ) )
			{
				return $id;
			}
			else
			{
				throw new Exception( "requirement: $c" );
			}
		}
	}
}

