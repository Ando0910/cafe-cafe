<?php
$yen = 10000;   // 購入金額
$product = 150; // 商品金額



function calc($yen, $product)
{
    // この関数内に処理を記述
    $change = $yen - $product;
    return $change;
}

function calcCoins($amount)
{
    $bills = [10000, 5000, 1000, 500, 100, 50, 10, 5, 1];
    $result = [];

    foreach ($bills as $bill) {
        $count = floor($amount / $bill);
        $amount %= $bill;
        $result[$bill] = $count;
    }
    return $result;
}

$changeAmount = calc($yen, $product);
if ($changeAmount >= 0) {
    $changeCoins = calcCoins($changeAmount);

    echo "{$yen}円で購入した場合、\n";
    echo "10000円札x{$changeCoins[10000]}枚、";
    echo "5000円札x{$changeCoins[5000]}枚、";
    echo "1000円札x{$changeCoins[1000]}枚、";
    echo "500円玉x{$changeCoins[500]}枚、";
    echo "100円玉x{$changeCoins[100]}枚、";
    echo "50円玉x{$changeCoins[50]}枚、";
    echo "10円玉x{$changeCoins[10]}枚、";
    echo "5円玉x{$changeCoins[5]}枚、";
    echo "1円玉x{$changeCoins[1]}枚\n";
} else {
    $remainingAmount = abs($changeAmount);
    echo "{$yen}円で購入した場合、" . "\n";
    echo "{$remainingAmount}円足りません。" . "\n";
}
