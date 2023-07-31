<?php
require ROOT . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$direct_output = true;

$query = "select f.title, f.content, f.ts, u.phone from feedback f
left join user u
   on f.userId = u.id
";

$list = $app->db()->simpleQuery( $query, false, false, PDO::FETCH_NUM );

$list = array_merge( [[
	                      '标题',
	                      '内容',
	                      '时间',
	                      '电话',
                      ]], $list );

/*echo '<pre>';
var_dump( $list);
exit();*/

$xlsx = $app->createExcelFile( $list );

$filename = 'feedback.xlsx';

$app->sendBinaryFile( $filename, $xlsx, "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
