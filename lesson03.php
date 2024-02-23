<?php

$num1 = 1;  // 分子
$deno1 = 10; // 分母
$num2 = 5;  // 分子
$deno2 = 6; // 分母



function calcFraction($num1, $deno1, $num2, $deno2)
{
  // この関数内に処理を記述

  $deno = lcm($deno1, $deno2);
  $numA = ($deno / $deno1) * $num1;
  $numB = ($deno / $deno2) * $num2;
  $numTotal = $numA + $numB;


  $gcd = gcd($numTotal, $deno);
  $numTotal /= $gcd;
  $deno /= $gcd;


  echo "$num1/$deno1 + $num2/$deno2 = $numTotal/$deno\n";
}
// 最大公約数
function gcd($m, $n)
{
  if ($n > $m) list($m, $n) = array($n, $m);

  while ($n !== 0) {
    $tmp_n = $n;
    $n = $m % $n;
    $m = $tmp_n;
  }
  return $m;
}
// 最小公倍数
function lcm($m, $n)
{
  return $m * $n / gcd($m, $n);
}
calcFraction($num1, $deno1, $num2, $deno2);
