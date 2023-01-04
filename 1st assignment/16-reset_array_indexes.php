<?php

(function () {
    $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

    unset($numbers[2], $numbers[5], $numbers[9]);

    $numbers = array_values($numbers);

    echo ANSI_COLORS['blue'];
    print_r($numbers);
    echo ANSI_COLORS['reset'];
})();
