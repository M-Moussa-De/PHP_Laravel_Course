<?php

(function () {
    $names = ['John', 'Mark', 'Tim', 'Alejando', 'Rebeeca', 'Alessandro'];

    usort($names, fn ($a, $b) => strlen($b) - strlen($a));

    printf("%sThe longest name is %s%s%s", ANSI_COLORS['blue'], $names[0], ANSI_COLORS['reset'], PHP_EOL);
})();
