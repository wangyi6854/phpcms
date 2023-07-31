<?php

if ( !empty( $_POST ) )
{

	if ( $username && $password )
	{

		$db = $app->db();

		$query = "insert into user ( username, password ) values ( " . $db->quote( $username ) . ", " . $db->quote( $password ) . " )";

		if ( $db->exec( $query ) )
		{
			$msg = "注册成功";
			$r = 0;
		}
		else
		{
			$msg = "用户名已存在";
			$r = 1;
		}

	}
	else
	{
		$msg = "请完整填写";
		$r = 2;
	}


	$format = 'json';

	$data = [
		'message'	=> $msg,
		'result'	=> $r,
	];
}