<?php

(function () {
    $numbers = range(1, 100);

    printf("%sDivided by 3: %s%s", ANSI_COLORS['green'], ANSI_COLORS['reset'], PHP_EOL);
    for ($i = 3; $i < count($numbers); $i += 3) {
        printf("%s%s,%s", ANSI_COLORS['blue'], $i, ANSI_COLORS['reset']);
    }

    echo PHP_EOL;

    printf("%sDivided by 5: %s%s", ANSI_COLORS['green'], ANSI_COLORS['reset'], PHP_EOL);
    for ($i = 5; $i < count($numbers); $i += 5) {
        printf("%s%s,%s", ANSI_COLORS['blue'], $i, ANSI_COLORS['reset']);
    }

    echo PHP_EOL;

    printf("%sDivided by 3 & 5: %s%s", ANSI_COLORS['green'], ANSI_COLORS['reset'], PHP_EOL);
    for ($i = 15; $i < count($numbers); $i += 15) {
        printf("%s%s,%s", ANSI_COLORS['blue'], $i, ANSI_COLORS['reset']);
    }

    echo PHP_EOL;
})();
