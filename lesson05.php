<?php
for ($i = 1; $i <= 4; $i++) {
    for ($j = 0; $j <= $i - 2; $j++) {
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
