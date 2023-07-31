<?php


$obj = new Ticket( $id );

$obj->delete();

header( 'Location: ./?module=admin.ticket.list' );
exit();