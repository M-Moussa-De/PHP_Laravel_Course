<?php

printf("%sHere are the odd numbers starting from 1 untill 99:%s%s", ANSI_COLORS['blue'], ANSI_COLORS['reset'], PHP_EOL);

for ($i = 1; $i < 100; $i++) {
    $i % 2 !== 0 ? printf("%s%s%s%s", ANSI_COLORS['blue'], $i, ANSI_COLORS['reset'], PHP_EOL) : '';
}
