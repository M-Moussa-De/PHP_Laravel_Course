<?php

function sortAsc(array $arr): ?array
{
  $len = count($arr);

  if ($len < 2) return null;

  for ($i = 0; $i < $len; $i++) {
    for ($j = 0; $j < $len - 1; $j++) {
      if ($arr[$j] > $arr[$i]) {

        $temp = $arr[$j];
        $arr[$j] = $arr[$i];
        $arr[$i] = $temp;
      }
    }
  }

  return $arr;
}

print_r(sortAsc([10, 8, 15, 1, 30, 29, 17, 21]));
