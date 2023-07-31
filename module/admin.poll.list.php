<?php

$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];


$list = ( new PollList([
	'page'		=> $page,
	'pagesize'	=> $pagesize,
	'keyword'	=> $keyword,
	'order'		=> 'id desc'
]) )->output();

