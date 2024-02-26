<?php
function numberLoop()
{
    // この関数に判定処理を記述
    $result = "";
    for ($i = 1; $i <= 5; $i++) {
        for ($j = 1; $j <= 5 - $i; $j++) {
            $result .= "*";
        }
        for ($j = 1; $j <= $i; $j++) {
            $result .= $j;
        }
        for ($j = $i - 1; $j >= 1; $j--) {
            $result .= $j;
        }
        $result .= "<br/>";
    };
    for ($i = 1; $i <= 4; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            $result .= "*";
        }
        for ($j = 1; $j <= 5 - $i; $j++) {
            $result .= $j;
        }
        for ($j = $j - 2; $j >= 1; $j--) {
            $result .= $j;
        }
        $result .= "<br/>";
    };
    return $result;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>ループ表示</title>
</head>

<body>

    <!-- ここに表示例の通り表示 -->
    <?php
    echo numberLoop();
    ?>
</body>

</html>


<?php
