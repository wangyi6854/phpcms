<?php

$news = new News( $id );

$news->delete();

header( 'Location: ./?module=admin.news.list' );
exit();

