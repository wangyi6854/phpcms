<?php

$news = new News( $id );

$news->hide();

header( 'Location: ./?module=admin.news.list' );
exit();