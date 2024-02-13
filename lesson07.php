<?php
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5 - $i; $j++) {
        echo "*";
    }
    for ($j = 1; $j <= $i; $j++) {
        echo $j;
    }
    for ($j = $i - 1; $j >= 1; $j--) {
        echo $j;
    }
    echo "\n";
};
for ($i = 1; $i <= 4; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    for ($j = 1; $j <= 5 - $i; $j++) {
        echo $j;
    }
    for ($j = $j - 2; $j >= 1; $j--) {
        echo $j;
    }
    echo "\n";
};
