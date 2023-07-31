<?php

$id = 1;

$option_cat_list = $app->pollOptionCatList( $id );

$poll = new Poll( $id );

$code = intval( $code ) ? intval( $code ) : 1;

$data = $app->db()->simpleQuery( "select id, name, count, image from poll_option where pollId = $id and optionCat = $code order by count desc" );

$tabbar_index = 3;