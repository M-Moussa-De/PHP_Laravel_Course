<?php

function calcAvg(array $arr): ?float
{
  if (count($arr) < 1) return null;

  if (count($arr) === 1 && is_numeric($arr[0])) return $arr[0];

  $sum = 0;
  $len = 0;

  foreach ($arr as $num) {
    if (is_numeric($num)) {
      $sum += $num;
      $len++;
    }
  }

  return number_format($sum / $len, 2);
}

echo calcAvg([1, 2, 3, 5, 6, 7, 9, "Hello", 71, "World"]);
