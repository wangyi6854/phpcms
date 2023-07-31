<?php


$obj = new PollOption( $id );

$obj->delete();

header( 'Location: ./?module=admin.poll.option.list' );
exit();