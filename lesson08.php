<?php
$countries = [
    "日本" => "東京",
    "アメリカ" => "ワシントン",
    "イギリス" => "ロンドン",
    "フランス" => "パリ"
];
foreach ($countries as $key => $country) {
    echo "{$key}". "の首都は". "{$country}". "です。"."\n";
}
