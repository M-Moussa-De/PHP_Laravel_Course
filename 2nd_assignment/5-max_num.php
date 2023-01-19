<?php

function findMaxNumber(array $arr): ?float
{
  if (count($arr) < 1) return null;

  if (count($arr) === 1 && is_numeric($arr[0])) return $arr[0];

  $max = $arr[0];

  foreach ($arr as $num) {
    if (is_numeric($num) && $num > $max) {
      $max = $num;
    }
  }

  return $max;
}

echo findMaxNumber(['Text', 10, 215, 15, 108, 'Test']);
