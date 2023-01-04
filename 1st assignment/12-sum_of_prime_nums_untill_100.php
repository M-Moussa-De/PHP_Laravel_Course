<?php

// Method 1

// (function () {

//     $sum = 0;

//     for ($i = 2; $i < 100; $i++) {

//         $is_prime = true;

//         for ($j = 2; $j < $i; $j++) {
//             if ($i % $j === 0) {
//                 $is_prime = false;
//                 break;
//             }
//         }

//         if ($is_prime) $sum += $i;
//     }

//     printf("%sSum of prime numbers less upto 100: %s%s%s", ANSI_COLORS['blue'], $sum, ANSI_COLORS['reset'], PHP_EOL);
// })();

// method 2 using the sieve of Eratosthenes algorithm

(function () {
    $numbers = range(2, 99);

    for ($i = 0; $i < count($numbers); $i++) {
        $number = $numbers[$i];

        if ($number === null) {
            continue;
        }

        for ($j = $i + $number; $j < count($numbers); $j += $number) {
            $numbers[$j] = null;
        }
    }

    $primes = array_filter($numbers, fn ($n) => $n !== null);

    $sum = array_sum($primes);

    printf("%sSum of prime numbers less upto 100: %s%s%s", ANSI_COLORS['blue'], $sum, ANSI_COLORS['reset'], PHP_EOL);
})();
