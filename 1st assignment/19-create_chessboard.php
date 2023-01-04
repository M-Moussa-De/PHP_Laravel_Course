<?php

(function () {

    printf("%sEnter the size for chessboard: %s", ANSI_COLORS['blue'], ANSI_COLORS['reset']);

    while (true) {
        $size = readline();

        if (is_numeric($size)) {
            break;
        }

        printf("%The length must be an integer value%s%s", ANSI_COLORS['red'], ANSI_COLORS['reset'], PHP_EOL);
    }

    for ($row = 0; $row < $size; $row++) {
        for ($col = 0; $col < $size; $col++) {
            if (($row + $col) % 2 == 0) {
                echo "\033[47m \033[0m";
            } else {
                echo "\033[46m \033[0m";
            }
        }

        echo PHP_EOL;
    }
})();
