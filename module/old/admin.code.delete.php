<?php

if ( $_SESSION[ 'type' ] > -1 )
{
	header( 'Location: ./' );
	exit();
}


$obj = new Code( $id );

$obj->delete();

header( 'Location: ./?module=admin.code.list' );
exit();