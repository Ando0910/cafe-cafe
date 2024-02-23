<?php

// 手札テストケース
//  ロイヤルストレートフラッシュ
$cards = [
    ['suit' => 'heart', 'number' => 1],
    ['suit' => 'heart', 'number' => 10],
    ['suit' => 'heart', 'number' => 12],
    ['suit' => 'heart', 'number' => 13],
    ['suit' => 'heart', 'number' => 11],
];
//  ロイヤルストレートフラッシュjoker
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 10],
//     ['suit' => 'heart', 'number' => 12],
//     ['suit' => 'heart', 'number' => 13],
//     ['suit' => 'joker', 'number' => 0],
// ];
//  ストレートフラッシュ
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 3],
//     ['suit' => 'heart', 'number' => 4],
//     ['suit' => 'heart', 'number' => 5],
// ];
//  ストレートフラッシュjoker
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'joker', 'number' => 0],
//     ['suit' => 'heart', 'number' => 4],
//     ['suit' => 'heart', 'number' => 5],
// ];
//  フォーカード
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'diamond', 'number' => 1],
//     ['suit' => 'club', 'number' => 1],
//     ['suit' => 'heart', 'number' => 13],
// ];
//  フォーカードjoker
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'diamond', 'number' => 1],
//     ['suit' => 'joker', 'number' => 0],
//     ['suit' => 'heart', 'number' => 13],
// ];
//  フルハウス
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'diamond', 'number' => 1],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
// ];
//  フルハウスjoker
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'joker', 'number' => 0],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
// ];
//  フラッシュ
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'heart', 'number' => 4],
//     ['suit' => 'heart', 'number' => 10],
// ];
//  フラッシュjoker
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'heart', 'number' => 8],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'heart', 'number' => 4],
//     ['suit' => 'joker', 'number' => 0],
// ];
//  ストレート
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'diamond', 'number' => 3],
//     ['suit' => 'club', 'number' => 4],
//     ['suit' => 'heart', 'number' => 5],
// ];
//  ストレートjoker
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 2],
//     ['suit' => 'diamond', 'number' => 3],
//     ['suit' => 'joker', 'number' => 0],
//     ['suit' => 'heart', 'number' => 5],
// ];
//  スリーカード
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'club', 'number' => 1],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 4],
// ];
//  スリーカードjoker
// $cards = [
//     ['suit' => 'spade', 'number' => 1],
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'joker', 'number' => 0],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 4],
// ];
//  ツーペア
// $cards = [
//     ['suit' => 'spade', 'number' => 6],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'diamond', 'number' => 8],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 2],
// ];
//  ツーペアjoker(判定ではスリーカード)
// $cards = [
//     ['suit' => 'spade', 'number' => 6],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'diamond', 'number' => 8],
//     ['suit' => 'joker', 'number' => 0],
//     ['suit' => 'heart', 'number' => 2],
// ];
//  ワンペア
// $cards = [
//     ['suit' => 'spade', 'number' => 6],
//     ['suit' => 'heart', 'number' => 6],
//     ['suit' => 'diamond', 'number' => 8],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 10],
// ];
//  ワンペアjoker
// $cards = [
//     ['suit' => 'spade', 'number' => 6],
//     ['suit' => 'joker', 'number' => 0],
//     ['suit' => 'diamond', 'number' => 8],
//     ['suit' => 'club', 'number' => 2],
//     ['suit' => 'heart', 'number' => 10],
// ];
//  役なし
// $cards = [
//     ['suit' => 'heart', 'number' => 1],
//     ['suit' => 'spade', 'number' => 5],
//     ['suit' => 'club', 'number' => 10],
//     ['suit' => 'diamond', 'number' => 13],
//     ['suit' => 'heart', 'number' => 3],
// ];

function judge($cards)
{
    // この関数内に処理を記述
    $cover = array_unique($cards, SORT_REGULAR);
    $unique = count($cover);

    $suits = ['heart', 'spade', 'diamond', 'club', 'joker'];

    echo "手札は\n";
    foreach ($cards as $card) {
        echo $card['suit'] . $card['number'] . "  ";
        if ($card['number'] > 13 || $card['number'] < 0) {
            return "手札が不正";
        } elseif (!is_int($card['number'])) {
            return "\n" . "手札は不正です";
        } elseif (!in_array($card['suit'], $suits)) {
            return "\n" . "手札は不正です";
        } elseif ($card['suit'] == "joker" && $card['number'] != 0) {
            return "\n" . "手札は不正です";
        } elseif ($card['suit'] !== "joker" && $card['number'] == 0) {
            return "\n" . "手札は不正です";
        } elseif ($unique < 5)
            return "\n" . "手札は不正です";
    }
    echo "\n";

    // カードの並び替え
    $sort = array_column($cards, 'number');
    sort($sort);
    $suit_array = array_column($cards, 'suit');
    $countNum = array_count_values($sort);

    $search = 'joker';
    $jokerIncluded = in_array($search, $suit_array);

    $hasJoker = false;
    $numbers = array();
    $suits = array();
    foreach ($cards as $card) {
        if ($card['suit'] === 'joker') {
            $hasJoker = true;
        } else {
            $numbers[] = $card['number'];
            $suits[] = $card['suit'];
        }
    }

    $uniqueNumbers = array_unique($numbers);
    sort($uniqueNumbers);
    $uniqueSuits = array_unique($suits);


    $isStraight = false;
    if (count($uniqueNumbers) === 5 || ($hasJoker && count($uniqueNumbers) === 4)) {
        if ($hasJoker) {
            $isStraight = ($uniqueNumbers[3] - $uniqueNumbers[0] <= 4) || ($uniqueNumbers[2] - $uniqueNumbers[0] <= 3);
        } else {
            $isStraight = ($uniqueNumbers[4] - $uniqueNumbers[0] === 4);
        }
    }

    $isRoyalStraightFlush = false;
    $royalNumbers = [1, 10, 11, 12, 13];
    $diff = array_diff($royalNumbers, $uniqueNumbers);

    if (empty($diff) && count($uniqueSuits) === 1) {
        $isRoyalStraightFlush = true;
    } elseif (count($diff) === 1 && $hasJoker && count($uniqueSuits) <= 1) {
        $isRoyalStraightFlush = true;
    }

    if ($isRoyalStraightFlush) {
        $result = 1;
    } elseif (count(array_unique($suit_array)) === 1 && $isStraight || count(array_unique($suit_array)) === 2 && $isStraight) {
        $result = 2;
    } elseif (in_array(4, $countNum) || in_array(3, $countNum) && $jokerIncluded) {
        $result = 3;
    } elseif (in_array(3, $countNum) && in_array(2, $countNum) || (in_array(2, $countNum) && count(array_keys($countNum, 2)) == 2) && $jokerIncluded) {
        $result = 4;
    } elseif ((count(array_unique($suit_array)) === 1) || (count(array_unique($suit_array)) === 2) && ($jokerIncluded)) {
        $result = 5;
    } elseif ($isStraight) {
        $result = 6;
    } elseif (in_array(3, $countNum) || ((in_array(2, $countNum) && $jokerIncluded))) {
        $result = 7;
    } elseif ((in_array(2, $countNum) && count(array_keys($countNum, 2)) == 2) || ((in_array(2, $countNum) && $jokerIncluded))) {
        $result = 8;
    } elseif (in_array(2, $countNum)) {
        $result = 9;
    } elseif ($jokerIncluded) {
        $result = 9;
    } else {
        $result = 0;
    }
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
