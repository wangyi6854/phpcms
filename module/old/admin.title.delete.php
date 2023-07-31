<?php

if ( $_SESSION[ 'type' ] > -1 )
{
	header( 'Location: ./' );
	exit();
}


$obj = new Title( $id );

$obj->delete();

header( 'Location: ./?module=admin.title.list' );
exit();