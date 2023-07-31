<?php

class Content extends TableObject
{
	public $content		= '';

	public static function getIdByContent( $c )
	{
		global $app;

		$query = "select id from content where content = " . $app->db->quote( $c ) . " limit 1";

		if ( $id = (int) $app->db->simpleQuery( $query, true, true ) )
		{
			return $id;
		}
		else
		{
			$query = "insert into content ( content ) values ( " . $app->db->quote( $c ) . " )";
			if ( $id = (int) $app->db->simpleQuery( $query ) )
			{
				return $id;
			}
			else
			{
				throw new Exception( "content: $c" );
			}
		}
	}
}

