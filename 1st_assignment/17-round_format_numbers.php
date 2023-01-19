<?php

(function () {
    $salaries = [1550, 1321.23, 3751.48, 6423, 5332.89];

    $rounded_salaries = [];

    // method 1
    // foreach ($salaries as $salary) {

    //     $rounded_salaries[] = number_format(round($salary));
    // }

    // method 2
    $rounded_salaries = array_map(fn ($salary) =>  number_format(round($salary)), $salaries);

    ob_start();

    print_r($rounded_salaries);

    $output = ob_get_clean();

    printf("%s%s%s", ANSI_COLORS['blue'], $output, ANSI_COLORS['reset'], PHP_EOL);
})();
