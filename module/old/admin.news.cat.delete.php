<?php

$newsCat = new NewsCat( $id );

$newsCat->delete();

header( 'Location: ./?module=admin.news.cat.list' );
exit();