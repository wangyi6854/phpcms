<?php

/** @var int $step */
/** @var string $site */
/** @var string $name */
/** @var string $venue */
/** @var int $date */

$LHT = $venue == '非物质文化遗产展厅' ? true : false;

$step = $step == 0 ? 1 : $step;

if ( $step == 1 ) {
	$venuelist = $app->enumValuesFromCache('venue_schedule', 'name' );

    $tpl = 'venue.list';
}
elseif ( $step == 2 ) {
	list( $start_date, $end_date ) = $app->venueApplyNextPeriod();

	$query = "select * from venue_schedule where name = " . $app->db()->quote( $venue ) . " and 
	( 
		validFrom < '$start_date' and validEnd > '$start_date'
		or
		validFrom >= '$start_date' and validFrom <= '$end_date'	
	)
	order by validFrom, periodFrom";
	$schedule = $app->db()->simpleQuery( $query );

	$list = [];
	for ( $date = strtotime( $start_date ); $date <= strtotime( $end_date ); $date = $date + 86400 )
	{
		$tmp_list = [];
		foreach ( $schedule as $s )
		{
			if ( $app->scheduleDateisVaild( $date, $s ) )
			{
				$tmp_list[] = $s;
			}
		}

		if ( $tmp_list )
		{
			$list[ $date ] = $tmp_list;
		}
	}

	$tpl = 'venue.schedule.list';
}
elseif ( $step == 3 ) {
	$app->checkLogin();

	$venueSchedule = ( new VenueSchedule( $id ) )->output();

	$lastAppliedUserinfo = $app->getLastAppliedUserinfoForVenue( $_SESSION[ 'uid' ] );

	$tpl = 'venue.apply';
}
elseif ( $step == 4) {
    $app->checkLogin();
    $success = false;
    do{
        if ( !$name )
        {
            $data = '请填写姓名';
            break;
        }

        if ( !$app->verifyIdCard( $name, $idcard ) )
        {
            $data = '身份证号码和姓名不匹配';
            break;
        }


	    $userinfo_id = $app->addUser( $name, $idcard );
	    $userinfo = $app->userInfo( $userinfo_id );

        try {
            $app->db()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $app->db()->beginTransaction();

            $schedule = $app->db()->simpleQuery("select * from venue_schedule where id = $id for update", true );

            if ( $schedule[ 'maxCount' ] - $schedule[ 'count'] <= 0)
            {
                $data = '名额已满';
                $app->db()->rollBack();
            }
            elseif ( $schedule[ 'maxAge'] && $userinfo[ 'age' ] > $schedule[ 'maxAge'] || $schedule[ 'minAge'] && $userinfo[ 'age' ] < $schedule[ 'minAge'] )
            {
                $data = '您的年龄不符合要求';
                $app->db()->rollBack();
            }
			elseif ( !$app->scheduleDateisVaild( $date, $schedule ) )
			{
				$data = '日期不符';
				$app->db()->rollBack();
			}
            /*
            elseif ( $app->verifyAppliedCourse( $user[ 'id' ], $id ) ) {
                $data = '您已经报过名了';
                $app->db()->rollBack();
            }
            */
            elseif ( $userinfo[ 'sex' ] == '男' && $schedule[ 'sex'] == '女' || $userinfo[ 'sex' ] == '女' && $schedule[ 'sex' ] == '男' )
            {
                $data = '您的性别不符合要求';
                $app->db()->rollBack();
            }
            else
            {
                if ( $app->verifyAppliedVenue( $schedule[ 'name' ], $idcard ) )
                {
                    $data = '每人只能预约一次';
                    $app->db()->rollBack();
                }
                else
                {
                    $app->db()->exec( "insert into venue_apply ( userinfoId, venueScheduleId, date, applier ) value ( $userinfo_id, $id, '" . date( 'Y-m-d', $date ) . "', $_SESSION[uid] )");
                    $app->db()->exec( "update venue_schedule set `count` = `count` + 1 where id = $id" );

                    $app->db()->commit();
                    $success = true;
                    $data = '预约成功';
                }
            }
        } catch (Exception $e) {
            $app->db()->rollBack();
            $data = "您已经预约过了。";
            error_log( $e->getMessage() );
        }
    }
    while(0);

    $format = 'json';

    $data = [ 'success' => $success, 'message' => $data ];

}