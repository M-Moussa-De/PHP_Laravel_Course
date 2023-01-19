<?php

function generateRandomPassword(int $length): string
{
    $pass = '';
    $chars = range(33, 126);

    for ($i = 0; $i < $length; $i++) {
        $pass .= chr($chars[array_rand($chars)]);
    }

    return $pass;
}

(function () {

    echo "Enter the wanted length for your password: ";

    while (true) {

        $len = readline();

        if (is_numeric($len)) {
            break;
        }

        printf("%sThe length must be an integer value%s%s", ANSI_COLORS['red'], ANSI_COLORS['reset'], PHP_EOL);
    }

    $pass = generateRandomPassword($len);

    printf("%sYour random password is: %s%s%s%s", ANSI_COLORS['blue'], ANSI_COLORS['yellow'], $pass, ANSI_COLORS['reset'], PHP_EOL);
})();
