<?php

$id = 1;

$poll = new Poll( $id );
debug($poll->image);
$optionCatList = $app->db()->simpleQuery("select id, title from poll_option_cat where pollId = $id" );
$streetList = $app->enumValuesFromCache('poll_option', 'street' );

$tabbar_index = 2;