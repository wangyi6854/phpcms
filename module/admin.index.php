<?php

$user = new User( $_SESSION[ 'uid' ] );
if ( $user->needChangePassword() )
{
	header( 'Location: ./?module=admin.password.modify' );
	exit();
}

