<?php

$poll_option = new PollOption( $id );
$poll = new Poll( $poll_option->pollId );

$content = json_decode( $poll_option->content, true );
$video = $content[ 'video' ] ?? [];
$photo = $content[ 'photo' ] ?? [];


$tabbar_index = 2;