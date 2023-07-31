<?php

if ( $_SESSION[ 'type' ] > -1 )
{
	header( 'Location: ./' );
	exit();
}


$obj = new Requirement( $id );

$obj->delete();

header( 'Location: ./?module=admin.requirement.list' );
exit();