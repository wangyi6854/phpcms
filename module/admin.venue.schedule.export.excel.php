<?php
require ROOT . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$direct_output = true;

if ( date( 'N' ) == 1 )
{
	$start = $app->db()->quote( date( 'Y-m-d', strtotime( 'monday last week' ) ) );
	$end = $app->db()->quote( date( 'Y-m-d', strtotime( 'sunday last week' ) ) );
}
else
{
	$start = $app->db()->quote( date( 'Y-m-d', strtotime( 'monday this week' ) ) );
	$end = $app->db()->quote( date( 'Y-m-d' ) );
}

$query = "select 
    name, `date`, concat( periodFrom, '-', periodTo ), name, idcard, applier_phone, user_sex, TIMESTAMPDIFF(YEAR, birthday, CURDATE()) AS age 
from v_venue_apply
where date( apply_ts ) between $start and $end
order by apply_ts";
$list = $app->db()->simpleQuery( $query, false, false, PDO::FETCH_NUM );

$list = array_merge( [[
	                      '场地',
	                      '日期',
	                      '时间',
	                      '姓名',
	                      '身份证号',
	                      '电话',
	                      '性别',
	                      '年龄',
                      ]], $list );

/*echo '<pre>';
var_dump( $list);
exit();*/

$xlsx = $app->createExcelFile( $list );

$filename = '场地预约.xlsx';

$app->sendBinaryFile( $filename, $xlsx, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
