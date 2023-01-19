<?php


function filterAndRemoveEvenNumbers(array $arr): ?array
{
  $len = count($arr);

  if ($len < 1) return null;

  $oddNums = [];

  for ($i = 0; $i < $len; $i++) {
    if ((gettype($arr[$i] === 'integer') || gettype($arr[$i] === 'double'))
      && is_numeric($arr[$i]) && $arr[$i] % 2 !== 0
    ) {
      $oddNums[] = $arr[$i];
    }
  }

  return $oddNums;
}

print_r(filterAndRemoveEvenNumbers([10, 3, 5, 8, 'Hello', 2, 4, 1, 'World']));
