<?php

/** @var int $step */
/** @var string $name */
/** @var string $idcard */
/** @var string $street */

$step = $step == 0 ? 1 : $step;

if ( $step == 1 ) {
	//$query = "select * from ticket where showStart < now() and showEnd > now() order by id desc";
	$query = "select * from ticket order by id desc";
	$list = $app->db()->simpleQuery( $query );
	$tpl = 'ticket.list';
}
elseif ( $step == 2 ) {
    $app->checkLogin();
    if ( !$course = $app->db()->simpleQuery( "select * from ticket where id = $id", true ) )
    {
		header( "Location: ./" );
		exit();
    }

    //$_SESSION[ 'code' ] = rand(1000, 9999);

	$lastAppliedUserinfo = $app->getLastAppliedUserinfoForTicket( $_SESSION[ 'uid' ] );

	$tpl = 'ticket.apply';
}
elseif ( $step == 3) {
    $app->checkLogin();
    $success = false;
    do{
	    if ( !$name || !$idcard )
	    {
		    $data = '请填写姓名和身份证号码';
		    break;
	    }

        if ( !$app->verifyIdCard( $name, $idcard ) )
        {
            $data = '身份证号码和姓名不匹配';
            break;
        }

	    $userinfo_id = $app->addUser( $name, $idcard );
	    $userinfo = $app->userInfo( $userinfo_id );
		$app->updateUserStreet( $userinfo_id, $street );

	    try {
            $app->db()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $app->db()->beginTransaction();

            foreach ( $app->db()->simpleQuery("select * from ticket where id = $id for update" ) as $row )
            {
				$course = $row;
            }

            if ( $course[ 'maxCount' ] - $course[ 'count'] <= 0)
            {
                $data = '报名名额已满';
                $app->db()->rollBack();
            }
            elseif ( $course[ 'maxAge'] && $userinfo[ 'age' ] > $course[ 'maxAge'] || $course[ 'minAge'] && $userinfo[ 'age' ] < $course[ 'minAge'] ) {
                $data = '您的年龄不符合要求';
                $app->db()->rollBack();
            }
            elseif ( strtotime( $course[ 'applyStart' ] ) > time() ) {
                $data = '报名未开始';
                $app->db()->rollBack();
            }
            elseif ( strtotime( $course[ 'applyEnd' ] ) < time() ) {
                $data = '报名已结束';
                $app->db()->rollBack();
            }
            /*
            elseif ( $app->verifyAppliedCourse( $user[ 'id' ], $id ) ) {
                $data = '您已经报过名了';
                $app->db()->rollBack();
            }
            */
            elseif ( $userinfo[ 'sex' ] == '男' && $course[ 'sex'] == '女' || $userinfo[ 'sex' ] == '女' && $course[ 'sex' ] == '男' )
            {
                $data = '您的性别不符合要求';
                $app->db()->rollBack();
            }
            elseif ( $app->verifyAppliedTicket( $idcard, $id ) )
            {
                $data = '每人只能申请一次';
                $app->db()->rollBack();
            }
            else
            {
                $app->db()->exec( "insert into ticket_apply ( userinfoId, ticketId, applier ) value ( $userinfo_id, $id, $_SESSION[uid] )");
                $app->db()->exec( "update ticket set `count` = `count` + 1 where id = $id" );


                $app->db()->commit();
                $success = true;
                $data = '报名成功';

	            $background_operations_data = [
		            'mobile'    => $_SESSION[ 'mobile' ],
		            'title'     => $course[ 'title' ],
		            'count'     => $course[ 'num' ],
		            'date'      => $course[ 'start' ],
		            'address'   => $course[ 'address' ],
	            ];

	            function background_operations( $data )
	            {
		            require_once ROOT . './lib/AliSMS.php';

		            $sms = new AliSMS();

		            $sms->setTemplateCode( $GLOBALS [ 'config' ][ 'AliSMS' ][ 'templateCodeForTicketApplicationNotice' ] );

		            $sms->sendSMS( $data[ 'mobile' ], [
			            'title'  => $data[ 'title' ],
			            'count'  => $data[ 'num' ],
			            'date'  => $data[ 'start' ],
			            'address'  => $data[ 'address' ],
		            ] );

	            }

            }
        } catch (Exception $e) {
            $app->db()->rollBack();
            $data = "您已经申请过了。";
            error_log( $e->getMessage() );
        }
    }
    while(0);

    $format = 'json';

    $data = [ 'success' => $success, 'message' => $data ];

}