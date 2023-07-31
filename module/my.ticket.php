<?php

$app->checkLogin();

$query = "select *
from v_ticket_apply
where 
    applier_id = $_SESSION[uid]
	and ts > DATE_SUB(NOW(), INTERVAL 3 MONTH)
";

$list = $app->db()->simpleQuery( $query );
