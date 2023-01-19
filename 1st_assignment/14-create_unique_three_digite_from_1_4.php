<?php

(function () {
    $numbers = [];

    for ($i = 123; $i <= 432; $i++) {
        $digits = str_split($i);

        if (count(array_unique($digits)) === 3 && preg_match('/^[1-4]{3}$/', $i)) {
            $numbers[] = $i;
        }
    }

    foreach ($numbers as $number) {
        printf("%s%s%s%s", ANSI_COLORS['blue'], $number, ANSI_COLORS['reset'], PHP_EOL);
    }

    printf("%sThe total number of the three-digit-number is %s%s%s ", ANSI_COLORS['blue'], count($numbers), ANSI_COLORS['reset'], PHP_EOL);
})();
