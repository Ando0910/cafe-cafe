<?php
$week = array( '日', '月', '火', '水', '木', '金', '土' );

echo date("Y年m月d日"."(".$week[date("w")]."曜日)")."\n";


