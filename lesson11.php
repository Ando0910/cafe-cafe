<?php
$data = [
[
    'name' => '田中',
    'age' => '25',
    'gender' => '男',
],
[
    'name' => '鈴木',
    'age' => '20',
    'gender' => '男',
],
[
    'name' => '佐藤',
    'age' => '23',
    'gender' => '女',
]
];

foreach($data as $person) {
    foreach($person as $key => $value) {
        echo "{$value}";
    };
    echo "\n";
}
foreach($data as $person) {
    if($person["name"] === "鈴木") {
        echo $person["age"] ."\n";
    }
};


