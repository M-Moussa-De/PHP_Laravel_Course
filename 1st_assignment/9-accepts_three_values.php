<?php

function checkNumbers(int $num1, int $num2, int $num3): bool
{
    return ($num1 >= 20 && $num1 < min($num2, $num3)) ||
        ($num2 >= 20 && $num2 < min($num1, $num3)) ||
        ($num3 >= 20 && $num3 < min($num1, $num2));
}

$num1 = $num2 = $num3 = 0;

(function () {
    for ($i = 1; $i < 4; $i++) {

        printf("%sInput the %s number: %s%s", ANSI_COLORS['yellow'], $i == 1 ? 'first' : ($i == 2 ? 'second' : 'third'), ANSI_COLORS['reset'], PHP_EOL);

        while (true) {

            ${"num" . $i} = readline();

            if (is_numeric(${"num" . $i})) {
                break;
            }

            printf("%sThe value must be an integer%s%s", ANSI_COLORS['red'], ANSI_COLORS['reset'], PHP_EOL);
        }
    }
})();

printf("%s%s%s%s", ANSI_COLORS['blue'], checkNumbers($num1, $num2, $num3) ? 'True' : 'False', ANSI_COLORS['reset'], PHP_EOL);
