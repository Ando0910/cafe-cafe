<?php

function fizzbuzz($i)
{
    // この関数内に処理を記述
    if (($i % 3 == 0) && ($i % 5 == 0)) {
        echo "{$i}" . " FIzzBuzz" . "\n";
    } elseif ($i % 5 == 0) {
        echo "{$i}" . " Buzz" . "\n";
    } elseif ($i % 3 == 0) {
        echo "{$i}" . " FIzz" . "\n";
    } else {
        echo "{$i}" . "\n";
    }
}


for ($i = 1; $i <= 100; $i++) {
    fizzbuzz($i) . "\n";
}
