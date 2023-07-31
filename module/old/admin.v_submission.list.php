<?php

$target_user = new User( $userId );
$target_schedule = new Schedule( $scheduleId );

$where = 'where 1';

$where .= $scheduleId ? " and scheduleId = $scheduleId" : '';
$where .= $userId ? " and submitter = $userId" : '';
$where .= $year ? " and year( scSubmitStart ) = $year" : '';

$query = "select sql_calc_found_rows * from v_submission $where order by rrid";

list( $list, $num_result ) = $app->db->queryPage2( $query, $page, $pagesize );

$_SESSION[ 'return_to' ] =  $_SERVER[ 'REQUEST_URI' ];

$currentScheduleId = $scheduleId;
$currentYear = $year;
