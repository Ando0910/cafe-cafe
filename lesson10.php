<?php
function isLeapYear($year)
{
    // この関数に判定処理を記述
    for ($i = 1980; $i <= 2080; $i++) {
        if ((($i % 4 == 0) && !($i % 100 == 0)) || ($i % 400 == 0)) {
            echo "{$i}" . "はうるう年です。" . "\n";
        } else {
            echo "{$i}" . "\n";
        }
    }
}
isLeapYear($i);
