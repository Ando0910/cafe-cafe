<?php

$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];

for ($i = 1; $i <= 10; $i++)
    echo ("___");
echo ("\n");
echo "|______";

foreach ($arr as $row => $rowItem) {
    foreach ($rowItem as $c => $num)
        echo "|__" . "{$c}";
    echo "|横合計|";
    echo "\n";
    break;
}
$allTotal = 0;
foreach ($arr as $row => $columns) {

    echo "|____$row";
    $rowTotal = 0;
    foreach ($columns as $key => $value) {
        echo "|__$value";

        $rowTotal += $value;
    }
    echo "|_$rowTotal|\n";
    $allTotal += $rowTotal;
}


$columnTotal = ['c1' => 0, 'c2' => 0, 'c3' => 0];

foreach ($arr as $columns) {
    foreach ($columns as $key => $value) {

        $columnTotal[$key] += $value;
    }
}


echo "|縦合計";
foreach ($columnTotal as $value) {
    echo "|_$value";
}
echo "|$allTotal|";
echo ("\n");
for ($i = 1; $i <= 10; $i++)
    echo ("___");
echo ("\n");
