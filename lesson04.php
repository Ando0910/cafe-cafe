<?php

$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>テーブル表示</title>
    <style>
        table {
            border: 1px solid #000;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <!-- ここにテーブル表示 -->
    <table>
        <tr>
            <th></th>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>横合計</th>
        </tr>
        <?php
        foreach ($arr as $row => $columns) {
        ?>
            <tr>
                <th><?php echo $row; ?></th>
                <?php
                $rowTotal = 0;
                foreach ($columns as $column) {
                    $rowTotal += $column;
                ?>
                    <td><?php echo $column; ?></td>
                <?php } ?>
                <td><?php echo $rowTotal; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <th>縦合計</th>
            <?php
            $columnTotals = array_fill_keys(array_keys($arr['r1']), 0);
            foreach ($arr as $row => $columns) {
                foreach ($columns as $column => $value) {
                    $columnTotals[$column] += $value;
                }
            }
            foreach ($columnTotals as $total) {
            ?>
                <td><?php echo $total; ?></td>
            <?php } ?>
            <td><?php echo array_sum($columnTotals); ?></td>
        </tr>
    </table>


</body>

</html>
