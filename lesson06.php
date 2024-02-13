<?php
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= 5 - $i; $j++) {
        echo "*";
    }
    for ($j = 5; $j >= 6 - $i; $j--) {
        echo $j;
    }
    for ($j = 7 - $i; $j <= 5 ; $j++) {
        echo $j;
    }
    echo "\n";
};
