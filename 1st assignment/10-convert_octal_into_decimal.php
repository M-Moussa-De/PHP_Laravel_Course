<?php

function convertOctalIntoDecimal($num)
{
    return base_convert($num, 8, 10);
}

(function () {
    printf("%sInput any octal number: %s", ANSI_COLORS['blue'], ANSI_COLORS['reset']);

    $num = 0;

    while (true) {
        $num = readline();

        if (ctype_digit($num) && preg_match('/^[0-7]+$/', $num)) {
            break;
        }

        printf("%sNumber is not octal. Try another number:  %s", ANSI_COLORS['red'], ANSI_COLORS['reset']);
    }

    printf("%sEquivalent decimal number for %s : %s%s%s", ANSI_COLORS['blue'], $num, convertOctalIntoDecimal($num), ANSI_COLORS['reset'], PHP_EOL);
})();
