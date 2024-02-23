<?php

// 手札テストケース
//  ロイヤルストレートフラッシュ
$cards = [
    ['suit' => 'heart', 'number' => 1],
    ['suit' => 'heart', 'number' => 10],
    ['suit' => 'heart', 'number' => 11],
    ['suit' => 'heart', 'number' => 12],
    ['suit' => 'heart', 'number' => 13],
];
//
//  ストレートフラッシュ
// $cards = [
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 3],
//     ['suit' => 'heart', 'number' => 4],
//     ['suit' => 'heart', 'number' => 5],
//     ['suit' => 'heart', 'number' => 6],
// ];
//
//  フォーカード
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'diamond', 'number' => 1],
//     ['suit' => 'club', 'number' => 1],
//     ['suit' => 'heart', 'number' => 13],
// ];
//
//  フルハウス
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'diamond', 'number' => 1],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
// ];
//
//  フラッシュ
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'heart', 'number' => 4],
//     ['suit' => 'heart', 'number' => 10],
// ];
//
//  ストレート
// $cards = [
//     ['suit' => 'spade', 'number' => 3],
//     ['suit' => 'heart', 'number' => 4],
//     ['suit' => 'diamond', 'number' => 5],
//     ['suit' => 'club', 'number' => 6],
//     ['suit' => 'heart', 'number' => 7],
// ];
//
//  スリーカード
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'diamond', 'number' => 1],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 4],
// ];
//
//  ツーペア
// $cards = [
//     ['suit' => 'spade', 'number' => 6],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'diamond', 'number' => 8],
// ];
//
//  ワンペア
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 12],
//     ['suit' => 'heart', 'number' => 13],
//     ['suit' => 'heart', 'number' => 11],
// ];
//  役なし
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'spade', 'number' => 5],
//     ['suit' => 'heart', 'number' => 12],
//     ['suit' => 'heart', 'number' => 13],
//     ['suit' => 'heart', 'number' => 11],
// ];

function judge($cards)
{
    // この関数内に処理を記述
    // カードの不正チェック
    $cover = array_unique($cards, SORT_REGULAR);
    $unique = count($cover);

    $suits = ['heart', 'spade', 'diamond', 'club'];

    echo "手札は\n";
    foreach ($cards as $card) {
        echo $card['suit'] . $card['number'] . "  ";
        if ($card['number'] > 13 || $card['number'] < 1) {
            return "\n" . "手札は不正です";
        } elseif (!is_int($card['number'])) {
            return "\n" . "手札は不正です";
        } elseif (!in_array($card['suit'], $suits)) {
            return "手札は不正です";
        } elseif ($unique < 5)
            return "\n" . "手札は不正です";
    }
    echo "\n";

    // カードの並び替え
    $sort = array_column($cards, 'number');
    sort($sort);
    $suit_array = array_column($cards, 'suit');
    $countNum = array_count_values($sort);


    // 役判定
    $Straight = range($sort[0], $sort[4]) === $sort;
    if (($sort == [1, 10, 11, 12, 13]) && (count(array_unique($suit_array)) === 1)) {
        $result = 1;
    } elseif (count(array_unique($suit_array)) === 1 && $Straight) {
        $result = 2;
    } elseif (in_array(4, $countNum)) {
        $result = 3;
    } elseif (in_array(3, $countNum) && in_array(2, $countNum)) {
        $result = 4;
    } elseif (count(array_unique($suit_array)) === 1) {
        $result = 5;
    } elseif ($Straight) {
        $result = 6;
    } elseif (in_array(3, $countNum)) {
        $result = 7;
    } elseif (in_array(2, $countNum) && count(array_keys($countNum, 2)) == 2) {
        $result = 8;
    } elseif (in_array(2, $countNum)) {
        $result = 9;
    } else {
        $result = 0;
    }
    // 結果を返す
    switch ($result) {
        case 1:
            return "役はロイヤルストレートフラッシュです";
            break;
        case 2:
            return "役はストレートフラッシュです";
            break;
        case 3:
            return "役はフォーカードです";
            break;
        case 4:
            return "役はフルハウスです";
            break;
        case 5:
            return "役はフラッシュです";
            break;
        case 6:
            return "役はストレートです";
            break;
        case 7:
            return "役はスリーカードです";
            break;
        case 8:
            return "役はツーペアです";
            break;
        case 9:
            return "役はワンペアです";
            break;
        case 0:
            return "役はなしです";
            break;
    }
}
echo judge($cards) . "\n";
