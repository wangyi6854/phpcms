<?php

$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];


$list = ( new NewsList([
	'cat'		=> $cat,
	'page'		=> $page,
	'pagesize'	=> $pagesize,
	'keyword'	=> $keyword,
	'order'		=> 'status desc, id desc'
]) )->output();

$catList = (new NewsCatList())->output();



