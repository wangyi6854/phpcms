<?php

$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];

$list = ( new NewsCatList( $id ) )->output();

$parent_cat_name = $id ? ( new NewsCat( $id ) )->name : '';