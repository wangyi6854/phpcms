<?php

$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];

$list = ( new TagList([
	'page'		=> $page,
	'pagesize'	=> $pagesize,
	'keyword'	=> $keyword,
	'order'		=> 'id desc'
]) )->output();
