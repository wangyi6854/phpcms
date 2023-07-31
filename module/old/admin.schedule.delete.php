<?php

if ( $_SESSION[ 'type' ] > 1 )
{
	header( 'Location: ./' );
	exit();
}


$obj = new Schedule( $id );

$obj->delete();

header( 'Location: ./?module=admin.schedule.list' );
exit();