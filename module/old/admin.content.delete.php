<?php

if ( $_SESSION[ 'type' ] > -1 )
{
	header( 'Location: ./' );
	exit();
}


$obj = new Content( $id );

$obj->delete();

header( 'Location: ./?module=admin.content.list' );
exit();