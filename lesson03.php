<?php

function isLeapYear($year)
{
    // この関数に判定処理を記述
    $image_path = 'img/torch.png';
    if ((($year % 4 == 0) && !($year % 100 == 0)) || ($year % 400 == 0)) {
        return "
        <img src=" . $image_path . ">
        :{$year}年は閏年です。<br/>";
    } else {
        return "{$year}年<br/>";
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>うるう年判定</title>
</head>

<body>
    <!-- ここに表示例の通り表示 -->
    <?php
    for ($year = 1980; $year <= 2080; $year++) {
        echo isLeapYear($year);
    }
    ?>
</body>

</html>
