<?php
/** @var string $venue */

$app->checkLogin();

$query = "select *
from v_venue_apply 
where applier_id = $_SESSION[uid]
and ts > " . $app->db()->quote( date( 'Y-m-d', strtotime( 'monday this week' ) ) );

$list = $app->db()->simpleQuery( $query );

$LHT = $venue == '非物质文化遗产展厅' ? true : false;
