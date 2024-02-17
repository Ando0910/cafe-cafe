<?php
for ($i = 1; $i <= 4; $i++) {
    for ($j = 1; $j <= 4 - $i; $j++) {
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
