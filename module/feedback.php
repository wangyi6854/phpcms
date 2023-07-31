<?php

/** @var string $title */
/** @var string $content */

$app->checkLogin();

if ( $title && $content )
{
	$title = $app->db()->quote( $title );
	$content = $app->db()->quote( $content );
	$uid = $app->db()->quote( $_SESSION[ 'uid' ] );

	$app->db()->exec( "insert into feedback ( title, content, userId ) values ( $title, $content, $uid )" );
	$format = 'json';

	$data = [ 'success' => true, 'message' => '感谢您的反馈！' ];

}