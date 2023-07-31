<?php

class App extends Base
{
	public function __construct()
	{
		parent::__construct();
	}

	public function checkLogin()
	{
		if ( empty( $_SESSION[ 'uid' ] ) )
		{
			$_SESSION[ 'return_to' ] = $_SERVER[ 'REQUEST_URI' ];
			header( "Location: ./" );
			exit();
		}
	}

	public function login( $mobile ): bool
	{
		$_SESSION[ 'uid' ]    = $this->getUserIdOrCreateUser( $mobile );
		$_SESSION[ 'mobile' ] = $mobile;
		/*
		list( $_SESSION[ 'name' ], $_SESSION[ 'idcard' ] ) = $this->db->simpleQuery( "select name, idcard from user left join user_info on user.userInfoId = user_info.id where user.id = " . $_SESSION[ 'uid' ], true, false, PDO::FETCH_NUM );
		if ( strpos( $_SESSION[ 'idcard' ], 'temp' ) === 0 )
		{
			$_SESSION[ 'idcard' ] = '';
		}
		*/
		return true;
	}


	public function loginWithPassword( $username, $password )
	{
		foreach ( $this->db->query( "select * from user where username = " . $this->db->quote( $username ) . " and password = " . $this->db->quote( $password ) ) as $d )
		{
			$_SESSION[ 'uid' ]      = (int) $d[ 'id' ];
			$_SESSION[ 'username' ] = $d[ 'username' ];
			$_SESSION[ 'type' ]     = (int) $d[ 'type' ];

			return true;
		}

		return false;
	}

	public function liteList( $cat, $num )
	{
		return new NewsList( [
			                     'cat'       => $cat,
			                     'startId'   => 0,
			                     'pagesize'  => $num,
			                     'singleCat' => 1,
		                     ] );
	}

	public function sidenav_news( $num = 6 )
	{
		return new NewsList( [
			                     'cat'      => 2,
			                     'startId'  => 0,
			                     'pagesize' => $num,
			                     'order'    => '`read` desc, id desc',
		                     ] );
	}

	public function db(): DB
	{
		return $this->db;
	}

	/*
	public function latestReviewList( $uid )
	{
		$uid = (int) $uid;

		$query = "select id from review where status = '待审核' and uid = $uid order by id desc limit 2";
		$ids = $this->db->simpleQuery( $query );

		$cnt = count( $ids );

		if ( $cnt == 0 || $cnt == 1 )
		{
			$query = "select * from review where uid = $uid";
		}
		elseif ( $cnt > 1 )
		{
			$query = "select * from review where uid = $uid and id > " . $ids[ 0 ];
		}

		return $this->db->simpleQuery( $query );
	}

	public function latestReview( $uid )
	{
		$uid = (int) $uid;

		$query = "select * from review where uid = $uid order by id desc limit 1";
		return $this->db->simpleQuery( $query, true );
	}
	*/

	public function addReview( $uid, $status = '待审核', $comment = '' )
	{
		$reviewer = $_SESSION[ 'uid' ];

		$r = new Review( [
			                 'uid'      => $uid,
			                 'reviewer' => $reviewer,
			                 'comment'  => $comment,
			                 'status'   => $status,

		                 ] );

		return $r->save();
	}

	public function modulePrivilege( $module = null, $uid = null, $gid = null )
	{
		$uid    = $uid ?? $_SESSION[ 'uid' ] ?? 0;
		$gid    = $gid ?? $_SESSION[ 'type' ] ?? 0;
		$module = $module ?? $GLOBALS[ 'module' ];

		$key = "mp_{$uid}_{$gid}";

		static $mp = [];

		if ( !isset( $mp[ $key ] ) )
		{
			$mp[ $key ] = $this->db->simpleQuery( "select * from privilege where uid = " . $this->db->quote( $uid ) . " or gid = " . $this->db->quote( $gid ) . " order by module desc" );
		}

		if ( $mp[ $key ] )
		{
			$up = $gp = [];

			foreach ( $mp[ $key ] as $d )
			{
				if ( $d[ 'uid' ] && $d[ 'uid' ] == $uid )
				{
					$up[ $d[ 'module' ] ] = (bool) $d[ 'allow' ];
				}

				if ( $d[ 'gid' ] && $d[ 'gid' ] == $gid )
				{
					$gp[ $d[ 'module' ] ] = (bool) $d[ 'allow' ];
				}
			}

			// user
			foreach ( $up as $m => $a )
			{
				if ( strpos( $module, $m ) === 0 || $m == '@all' )
				{
					return $a;
				}
			}

			// group
			foreach ( $gp as $m => $a )
			{
				if ( strpos( $module, $m ) === 0 || $m == '@all' )
				{
					return $a;
				}
			}

		}

		return true;
	}

	public function headerItems()
	{
		$modules = $GLOBALS[ 'config' ][ 'admin_header_nav_items' ];

		foreach ( $modules as $m => $name )
		{
			if ( !$this->modulePrivilege( $m ) )
			{
				unset( $modules[ $m ] );
			}
		}

		return $modules;
	}

	public function verifySMSCode( $mobile, $code ): bool
	{
		if ( !is_mobile_number( $mobile ) )
		{
			return false;
		}

		if ( !preg_match( '/^\d{4}$/', $code ) )
		{
			return false;
		}

		$mobile = $this->db->quote( $mobile );
		$code   = $this->db->quote( $code );

		$query = "select count(*) as cnt from sms_log 
         where phone = $mobile and code = $code and success = 1 and TIMESTAMPDIFF(SECOND, ts, now()) < 600";
		return (bool) $this->db->simpleQuery( $query, true, true );
	}

	public function verifyIdCard( $name, $idcard ): bool
	{
		$name_db   = $this->db->quote( $name );
		$idcard_db = $this->db->quote( $idcard );

		$db_result = $this->db->simpleQuery( "select count(*) as cnt from idcard_log where result = 'Y' and name = $name_db and idcard = $idcard_db", true, true );
		if ( $db_result )
		{
			return true;
		}

		$result = idcard_verify( $idcard, $name );

		if ( $result[ 'code' ] == 0 )
		{
			return true;
		}

		return false;
	}

	public function addUser( $name, $idcard ): int
	{
		if ( !$name || !$idcard )
		{
			return 0;
		}

		$query = "select sex, birthday from idcard_log where name = " . $this->db->quote( $name ) . " and idcard = " . $this->db->quote( $idcard ) . " and result = 'Y'";
		list( $sex, $birthday ) = $this->db->simpleQuery( $query, true, false, PDO::FETCH_NUM );

		$query = "insert into user_info (idcard, name, sex, birthday) values ( " .
			$this->db->quote( $idcard ) . ', ' .
			$this->db->quote( $name ) . ', ' .
			$this->db->quote( $sex ) . ', ' .
			$this->db->quote( $birthday ) .
		" ) on duplicate key update ts = now()";
		$this->db->exec( $query );

		return (int) $this->db->lastInsertId();
	}

	public function getUserIdOrCreateUser( $mobile ): int
	{
		$query = "select id from user where phone = " . $this->db->quote( $mobile ) . ' order by id desc limit 1';

		if ( !$uid = $this->db->simpleQuery( $query, true, true ) )
		{
			$query = "insert into user (
                  `username`, `status`, `ip`, `phone`
            ) values ("
				. $this->db->quote( $mobile ) . ', '
				. $this->db->quote( '正常' ) . ', '
				. $this->db->quote( $GLOBALS[ 'ip' ] ) . ', '
				. $this->db->quote( $mobile ) .
				")";

			$this->db->exec( $query );

			$uid = $this->db->lastInsertId();

		}

		return (int) $uid;
	}

	public function verifyAppliedCourse( $uid, $cid ): bool
	{
		return (bool) $this->db->simpleQuery( "select count(*) from course_apply where courseId = $cid and userInfoId = $uid", true, true );
	}

	public function verifyAppliedTicket( $idcard, $tid ): bool
	{
		return (bool) $this->db->simpleQuery( "select count(*) from v_ticket_apply where idcard = " . $this->db->quote( $idcard ) . " and ticket_id = $tid", true, true );
	}

	public function verifyAppliedCourses(  $idcard, $season ): bool
	{
		return $this->db->simpleQuery( "select count(*) from v_course_apply where idcard = " . $this->db->quote( $idcard ) . " and seasonId = $season", true, true ) > 0;
	}

	public function scheduleDateisVaild( $date, $entry ): bool
	{
		if ( $date >= strtotime( $entry[ 'validFrom' ] ) && $date <= strtotime( $entry[ 'validEnd' ] ) )
		{
			if ( str_contains( $entry[ 'week' ], date( 'N', $date ) ) )
			{
				return true;
			}
		}

		return false;
	}

	public function verifyAppliedVenue( $name, $idcard ): bool
	{
		$uid = $this->db->quote( $_SESSION[ 'uid' ] );
		$ts  = $this->db->quote( date( 'Y-m-d', strtotime( 'monday this week' ) ) );
		$idcard = $this->db->quote( $idcard );

		if ( $name == '非物质文化遗产展厅' )
		{
			$query = "select count( * ) from v_venue_apply where idcard = $idcard and ts >= $ts and name = '$name'";
		}
		else
		{
			$query = "select count( * ) from v_venue_apply where idcard = $idcard and ts >= $ts and name != '非物质文化遗产展厅'";
		}

		return (bool) $this->db->simpleQuery( $query, true, true );
	}

	public function venueApplyNextPeriod(): array
	{
		$this_saturday = strtotime( 'this saturday' );

		return [ date( 'Y-m-d', strtotime( 'next monday', $this_saturday ) ), date( 'Y-m-d', strtotime( 'next friday', $this_saturday ) ) ];
	}

	public function exportCourseApplication( int $id, string $site = '' ): array
	{
		$site_db   = $this->db->quote( $site );
		$course_db = $id ? $this->db->quote( $id ) : '';

		$query = "select 
    title, site, classroom, name, idcard, applier_phone, user_sex, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age, apply_ts
from v_course_apply
where 1 ";

		if ( $site )
		{
			$query .= "and site = $site_db ";
		}

		if ( $id )
		{
			$query .= "and course_id = $course_db ";
		}

		$query .= " order by apply_ts";

		$list = $this->db->simpleQuery( $query, false, false, PDO::FETCH_NUM );

		$list = array_merge( [
			                     [
			                     ],
		                     ], $list );
		/*echo '<pre>';
		var_dump( $list);
		exit();*/

		$xlsx = $this->createExcelFile( $list );

		$filename = $site;
		if ( $id )
		{
			$filename .= '-' . $this->db->simpleQuery( "select title from course where id = $id", true, true );
			//$filename .= '-' . $id;
		}
		$filename = trim( $filename, '-' ) . '.xlsx';

		return [ $filename, $xlsx ];
	}

	public function exportTicketApplication( int $ticket_id ): array
	{
		$query = "select 
    title, address, start, name, idcard, applier_phone, user_sex, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age, apply_ts
from v_ticket_apply
where ticket_id = $ticket_id order by ticket_apply_id";

		$list = $this->db->simpleQuery( $query, false, false, PDO::FETCH_NUM );

		$list = array_merge( [
			                     [
			                     ],
		                     ], $list );
		/*echo '<pre>';
		var_dump( $list);
		exit();*/

		$xlsx = $this->createExcelFile( $list );

		$filename = $this->db->simpleQuery( "select title from ticket where id = $ticket_id", true, true );
		$filename = trim( $filename, '-' ) . '.xlsx';

		return [ $filename, $xlsx ];
	}

	public function exportTicketApplicationForSMS( int $ticket_id ): array
	{
		$query = "select 
    u.phone, t.title, t.num, t.start, t.address
from ticket_apply a
left join ticket t
   on a.ticketId = t.id
left join user u
   on a.userinfoId = u.id
where a.ticketId = $ticket_id order by a.id";

		$list = $this->db->simpleQuery( $query, false, false, PDO::FETCH_NUM );

		$list = array_merge( [
			                     [
				                     'phone',
				                     'title',
				                     'count',
				                     'date',
				                     'address',
			                     ],
		                     ], $list );
		/*echo '<pre>';
		var_dump( $list);
		exit();*/

		$xlsx = $this->createExcelFile( $list );

		$filename = $this->db->simpleQuery( "select title from ticket where id = $ticket_id", true, true );
		$filename = trim( $filename, '-' ) . '.xlsx';

		return [ $filename, $xlsx ];
	}

	public function createExcelFile( $data ): string
	{
		$stringValueBinder = new \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder();
		$stringValueBinder->setNumericConversion( false )
			->setBooleanConversion( false )
			->setNullConversion( false )
			->setFormulaConversion( false );
		\PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( $stringValueBinder );

		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
		$sheet       = $spreadsheet->getActiveSheet();
		$sheet->fromArray( $data );

		ob_start();

		$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter( $spreadsheet, 'Xlsx' );
		$writer->save( 'php://output' );

		$spreadsheet->disconnectWorksheets();
		unset( $spreadsheet );

		$xlsx = ob_get_contents();
		ob_end_clean();

		return $xlsx;
	}

	public function sendBinaryFile( string $filename, $contents, string $mime )
	{
		while ( @ob_end_clean() )
		{
			;
		}

		header( "Content-Type: $mime" );
		header( 'Content-Disposition: attachment; filename="' . urlencode( $filename ) . '"' );
		header( 'Cache-Control: max-age=0' );
		header( 'Cache-Control: max-age=1' );
		header( 'Cache-Control: cache, must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . strlen( bin2hex( $contents ) ) / 2 );

		echo $contents;
		exit();
	}

	public function addSMSJob( $phone, $template, $data )
	{
		$stmt = $this->db->prepare( "insert into sms_job ( phone, template, data ) value ( :phone, :template, :data )" );

		$stmt->execute( [
			                'phone'    => $phone,
			                'template' => $template,
			                'data'     => json_encode( $data ),
		                ] );
	}

	public function pollOptionCatList( int $id )
	{
		global $cache;

		$cacheKey = "poll_option_cat_list_$id";

		if ( isset( $cache->$cacheKey ) )
		{
			$option_cat_list = $cache->$cacheKey;
		}
		else
		{
			$option_cat_list = $this->db->simpleQuery( "select id, title from poll_option_cat where pollId = $id" );

			$cache->$cacheKey = $option_cat_list;
		}

		return $option_cat_list;
	}

	public function saveAliyunCallbackMessage( $message )
	{
		$status = $this->db->quote( $message[ 'Status' ] );
		$body   = $this->db->quote( json_encode( $message ) );

		$this->db->exec( "insert into aliyun_callback ( status, message ) values ( $status, $body )" );
	}

	public function updateAliyunVideo( string $videoId, $data )
	{
		$update = '';

		foreach ( $data as $k => $v )
		{
			$update .= " $k = " . $this->db->quote( $v ) . ',';
		}

		$update = trim( $update, ',' );

		$this->db->exec( "update aliyun_video set $update where videoId = " . $this->db->quote( $videoId ) );

	}

	public function updatePollOptionImage( $pollOptionId, $videoId )
	{
		if ( $videoId )
		{
			$query = "select pollOptionId from aliyun_video where videoId = " . $this->db->quote( $videoId );
			$pollOptionId = $this->db->simpleQuery( $query, true, true );
		}

		if ( $pollOptionId )
		{
			$pollOptionId = $this->db->quote( $pollOptionId );
			$query = "update poll_option set image = ( select poster from aliyun_video where pollOptionId = $pollOptionId ) where id = $pollOptionId";
			$this->db->exec( $query );
		}

	}

	public function courseSeasonList() : array
	{
		return $this->db->simpleQuery("select id, name from course_season order by id desc");
	}

	public function userInfo( $uid ) : array
	{
		return $this->db->simpleQuery( "select *, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age from user_info where id = $uid", true );
	}

	public function appliedCourseInfo( $uid, $season ) : array
	{
		$query = "
			select 
			    c.id cid, a.id aid
			from course_apply a
			    left join user_info i on a.userInfoId = i.id
				left join course c on c.id = a.courseId
			where c.seasonId = $season and i.id = " . $this->db->quote( $uid );
		if ( $data = $this->db->simpleQuery( $query, true, false, PDO::FETCH_NUM ) )
		{
			return $data;
		}

		return [ 0, 0 ];
	}

	public function getLastAppliedUserinfoForCourse( $applier )
	{
		return $this->db->simpleQuery( "select name, idcard from v_course_apply where applier_id = $applier order by course_apply_id desc limit 1", true );
	}

	public function getLastAppliedUserinfoForTicket( $applier )
	{
		return $this->db->simpleQuery( "select name, idcard from v_ticket_apply where applier_id = $applier order by ticket_apply_id desc limit 1", true );
	}

	public function getLastAppliedUserinfoForVenue( $applier )
	{
		return $this->db->simpleQuery( "select user_name, idcard from v_venue_apply where applier_id = $applier order by venue_apply_id desc limit 1", true );
	}

	public function getCourseNoticeInfo( $season )
	{
		return $this->db->simpleQuery( "select notice_title, notice_content from course_season where id = $season", true, false, PDO::FETCH_NUM );
	}

	public function updateUserStreet( $id, $street )
	{
		$street = $this->db->quote( $street );
		return $this->db->exec( "update user_info set street = $street where id = $id" );
	}














}

