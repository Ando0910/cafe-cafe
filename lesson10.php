<?php
$scores = [
    10,
    60,
    90,
    70,
    50
];

foreach ($scores as $score){
    if($score >= 80) {
        echo "{$score}"."点は優です。"."\n";
    } elseif($score >= 60) {
        echo "{$score}"."点は良です。"."\n";
    } elseif($score >= 40) {
        echo "{$score}"."点は可です。"."\n";
    } else {
        echo "{$score}"."点は不可です。"."\n";
    }
};
