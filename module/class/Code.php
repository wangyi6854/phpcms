<?php

class Code extends TableObject
{
	public $content		= '';

	public static function getIdByContent( $c )
	{
		global $app;

		$query = "select id from code where content = " . $app->db->quote( $c ) . " limit 1";

		if ( $id = (int) $app->db->simpleQuery( $query, true, true ) )
		{
			return $id;
		}
		else
		{
			$query = "insert into code ( content ) values ( " . $app->db->quote( $c ) . " )";
			if ( $id = (int) $app->db->simpleQuery( $query ) )
			{
				return $id;
			}
			else
			{
				throw new Exception( "code: $c" );
			}
		}
	}
}

