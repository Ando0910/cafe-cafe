<?php
// 手札
function hand()
{
    $cards = [];
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["suit$i"]) && isset($_POST["number$i"])) {
            $suit = $_POST["suit$i"];
            $number = $_POST["number$i"];
            $cards[] = ['suit' => $suit, 'number' => $number];
        }
    }

    return $cards;
}

// 判定
function judge($cards)
{
    // この関数内に処理を記述
    // カードの不正チェック
    $cover = array_unique($cards, SORT_REGULAR);
    $unique = count($cover);

    $suits = ['heart', 'spade', 'diamond', 'club'];

    foreach ($cards as $card) {
        $number = filter_var($card['number'], FILTER_VALIDATE_INT);
        if ($number === false || $card['number'] > 13 || $card['number'] < 1) {
            return "\n" . "手札は不正です";
        } elseif (!in_array($card['suit'], $suits)) {
            return "手札は不正です";
        } elseif ($unique < 5)
            return "\n" . "手札は不正です";
    }

    // 役判定
    $numbers = array_column($cards, 'number');
    sort($numbers);
    $suit_array = array_column($cards, 'suit');
    $countNum = array_count_values($numbers);

    $Straight = true;
    for ($i = 0; $i < count($numbers) - 1; $i++) {
        if ($numbers[$i] + 1 != $numbers[$i + 1]) {
            $Straight = false;
            break;
        }
    }

    if (($numbers == [1, 10, 11, 12, 13]) && (count(array_unique($suit_array)) === 1)) {
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

    switch ($result) {
        case 1:
            return "ロイヤルストレートフラッシュです";
            break;
        case 2:
            return "ストレートフラッシュです";
            break;
        case 3:
            return "フォーカードです";
            break;
        case 4:
            return "フルハウスです";
            break;
        case 5:
            return "フラッシュです";
            break;
        case 6:
            return "ストレートです";
            break;
        case 7:
            return "スリーカードです";
            break;
        case 8:
            return "ツーペアです";
            break;
        case 9:
            return "ワンペアです";
            break;
        case 0:
            return "なしです";
            break;
    }
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
    <title>ポーカー役判定</title>
</head>

<body>
    <form action="#" method="POST" name="formtype">
        <section>
            <div class="flex">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="card">
                        <p><?php echo $i . ":" ?>
                            <select name="<?php echo "suit" . $i ?>" class="suit">
                                <option value=""></option>
                                <option value="spade">spade</option>
                                <option value="diamond">diamond</option>
                                <option value="heart">heart</option>
                                <option value="club">club</option>
                            </select>
                            <select name="<?php echo "number" . $i ?>">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                            </select>
                    </div>
                <?php } ?>
                <button type="submit" class="button1" name="submit">判定</button>
            </div>
            <div>
                <!-- 「hand」関数を使用してセレクトボックスで入力した手札を戻り値で取得し、ブラウザー上で表示する。 -->
                <!-- 引数の仕様有無は各自の判断に任せるとする。-->
                <?php if (!empty($_POST)) : ?>
                    <p>手札は
                        <?php foreach (hand() as $card) : ?>
                            <?= htmlspecialchars($card['suit']) . " " . htmlspecialchars($card['number']) . "　"; ?>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>
            </div>
            <div>
                <!-- 「judge」関数を使用してセレクトボックスで入力した手札から役を戻り値で取得し、ブラウザー上で表示する。 -->
                <!-- 引数の仕様有無は各自の判断に任せるとする。-->
                <p>役は<?php
                        $cards = hand();
                        echo judge($cards); ?>
                </p>
            </div>
        </section>
    </form>
</body>

</html>
