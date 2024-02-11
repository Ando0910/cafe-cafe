<?php
echo date("Y年m月d日"."H時i分s秒")."\n";
echo date("Y年m月d日"."H時i分s秒", strtotime('+3 day'))."\n";
echo date("Y年m月d日"."H時i分s秒", strtotime('-12 hour'))."\n";
$today = new DateTime("now");
$day = new DateTime("2020-01-01");
$diff = $today->diff($day);
echo $diff->days."日"."\n";
