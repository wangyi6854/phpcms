<?php

/** @var int $step */
/** @var string $site */
/** @var string $name */
/** @var string $idcard */
/** @var int $season */

if ( $step && !$season )
{
	header( "Location: ./?module=course.apply" );
	exit();
}

if ( $step == 0 ) {
	$courseSeasonList = (new CourseSeasonList())->output();

	$tpl = 'course.season.list';
}
elseif ( $step == 1 ) {
	$sitelist = (new SiteList())->output();

	$tpl = 'course.site.list';
}
elseif ( $step == 2 ) {
	list( $notice_title, $notice_content ) = $app->getCourseNoticeInfo( $season );
    $tpl = 'notice.1';
}
elseif ( $step == 3 ) {
    $site_db = $app->db()->quote( $site );
    $query = "select * from course where site = $site_db and seasonId = $season and showStart < now() and showEnd > now() order by id desc";
    $list = $app->db()->simpleQuery( $query );
    $tpl = 'course.list';
}
elseif ( $step == 4 ) {
    $app->checkLogin();
    $course = $app->db()->simpleQuery( "select * from course where id = $id", true );
    //$_SESSION[ 'code' ] = rand(1000, 9999);

	$lastAppliedUserinfo = $app->getLastAppliedUserinfoForCourse( $_SESSION[ 'uid' ] );
    $tpl = 'course.apply';
}
elseif ( $step == 5) {
    $app->checkLogin();
    $success = false;
    do
    {
	    /*
	     * 验证手机
	     *

		if ( !$app->verifySMSCode( $mobile, $code ) )
		{
			$data = '验证码错误';
			break;
		}

		if ( !is_mobile_number( $mobile ) )
		{
			$data = '手机号码不正确';
			break;
		}
		*/


	    /*
	     * 验证姓名和身份证号
	     */

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

		/*
	    if ( !$app->isCurrentUser( $idcard ) )
	    {
		    $data = '身份证号码已经绑定在其他手机号下。请使用该手机号码登录。';
		    break;
	    }
		*/

	    $userinfo_id = $app->addUser( $name, $idcard );
        $userinfo = $app->userInfo( $userinfo_id );
        list( $old_cid, $course_apply_id ) = $app->appliedCourseInfo( $userinfo_id, $season );

        //$app->login( $mobile );

        try {
            $app->db()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $app->db()->beginTransaction();

            foreach ( $app->db()->simpleQuery("select * from course where id in ( $id, $old_cid ) for update" ) as $row )
            {
                if ( $row[ 'id'] == $id )
                {
                    $course = $row;
                }

                if ( $row[ 'id' ] == $old_cid )
                {
                    $old_course = $row;
                }
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
            else
            {
                /** @var int $alt_course */
                if ( $alt_course )
                {
                    if ( $old_cid )
                    {
                        if ( $old_cid == $id )
                        {
                            $data = '请选择不同课程报名';
                            $app->db()->rollBack();
                        }
                        else
                        {
                            $app->db()->exec("update course_apply set courseId = $id where id = $course_apply_id" );
                            $app->db()->exec("update course set count = count - 1 where id = $old_cid" );
                            $app->db()->exec("update course set count = count + 1 where id = $id" );

                            $app->db()->commit();
                            $success = true;
                            $data = '更改报名成功';
                        }
                    }
                    else
                    {
                        $data = '您没有已报报名';
                        $app->db()->rollBack();
                    }
                }
                else
                {
                    if ( $app->verifyAppliedCourses( $userinfo_id, $season ) )
                    {
                        $data = '每人只能报一门课';
                        $app->db()->rollBack();
                    }
                    else
                    {
                        $app->db()->exec( "insert into course_apply ( userInfoId, courseId, applier ) value ( $userinfo_id, $id, $_SESSION[uid] )");
                        $app->db()->exec( "update course set `count` = `count` + 1 where id = $id" );

                        $app->db()->commit();
                        $success = true;
                        $data = '报名成功';
                    }
                }
            }
        } catch (Exception $e) {
            $app->db()->rollBack();
            $data = "您已经报过名了。";
            error_log( $e->getMessage() );
        }
    }
    while(0);

    $format = 'json';

    $data = [ 'success' => $success, 'message' => $data ];

}