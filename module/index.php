<?php

$page_title = '市南文化馆';

if ( !empty( $_SESSION[ 'uid' ] ) )
{
    header( "Location: ./?module=my.course" );
    exit();
}

