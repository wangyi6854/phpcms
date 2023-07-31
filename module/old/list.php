<?php


$list = new NewsList([
	"cat"		=> $cat,
	"keyword"	=> $keyword,
	"startId"	=> $start_id,
	"pagesize"	=> $pagesize,
]);

if ( $cat == 3 )
{
	if ( !empty( $list->list[ 0 ] ) )
	{
		header( 'Location: ./?module=news&id=' . $list->list[ 0 ]->id );
		exit();
	}
}

if ( $cat == 4 )
{
	$tpl = 'list.video';
}

if ( $cat == 5 )
{
	$tpl = 'list.question';
}

$newscat = $cat ? new NewsCat( $cat ) : new NewsCat( $cat2 );

$page_title = $keyword ? "\"$keyword\" 的搜索结果" : $newscat->name;

$sidenav_news = $app->sidenav_news();

