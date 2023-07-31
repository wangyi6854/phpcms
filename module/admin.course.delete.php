<?php


$obj = new Course( $id );

$obj->delete();

header( 'Location: ./?module=admin.course.list' );
exit();