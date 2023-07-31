<?php

$app->checkLogin();

/*
$query = "select a.*, c.applyEnd, c.applyStart, c.classroom, c.site, c.start, c.teacher, c.title, u.name, u.idcard, GROUP_CONCAT(u.name) gname
from course_apply a
left join course c
    on a.courseId = c.id
left join user u
         on a.userId = u.id
where a.applier = $_SESSION[uid]
group by a.courseId"
;
*/

$query = "select a.*, c.applyEnd, c.applyStart, c.classroom, c.site, c.start, c.teacher, c.title, c.seasonId, cs.name season_name, u.name, u.idcard, u.name gname
from course_apply a
inner join course c
    on a.courseId = c.id
inner join user_info u
         on a.userInfoId = u.id
left join course_season cs
    on c.seasonId = cs.id
where a.applier = $_SESSION[uid]
";

$list = $app->db()->simpleQuery( $query );
