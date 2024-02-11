<?php
$randomNumbers = array_unique(array_map(function() {
    return mt_rand(0, 99);
}, array_fill(0, 10, 0)));

var_dump($randomNumbers);
