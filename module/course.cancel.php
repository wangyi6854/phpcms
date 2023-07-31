<?php
$app->checkLogin();

$success = false;

if ( $apply = $app->db()->simpleQuery( "select * from course_apply where applier = " . $_SESSION[ 'uid' ] . " and id = $id", true ) )
{
	try {
		$app->db()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$app->db()->beginTransaction();

		$app->db()->exec( "delete from course_apply where id = " . $apply[ 'id' ] );
		$app->db()->exec( "update course set `count` = `count` - 1 where id = " . $apply[ 'courseId' ] );

		$app->db()->commit();
		$success = true;
		$data = '取消报名成功';

	} catch (Exception $e) {
		$app->db()->rollBack();
		$data = "目前无法取消报名";
		error_log( $e->getMessage() );
	}

}

$format = 'json';

$data = [ 'success' => $success, 'message' => $data ];

