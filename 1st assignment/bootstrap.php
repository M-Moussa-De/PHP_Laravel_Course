<?php

define('ANSI_COLORS', [
    'black' => chr(27) . "\033[30m",
    'red' => chr(27) . "\033[31m",
    'green' => chr(27) . "\033[32m",
    'yellow' => chr(27) . "\033[33m",
    'blue' => chr(27) . "\033[34m",
    'magenta' => chr(27) . "\033[35m",
    'cyan' => chr(27) . "\033[36m",
    'white' => chr(27) . "\033[37m",
    'light_blue' => chr(27) . "\033[46m",
    'reset' => chr(27) . "\033[0m",
]);


$scan_files_name = scandir('./');
$files = [];

foreach ($scan_files_name as $file) {
    if (preg_match('/^[0-9]/', $file) && file_exists($file)) {
        $files[] = $file;
    }
}

$file_found = false;
$index = 0;

printf("%sEnter the file number you want to excute: e.g. 1, 2,... %s", ANSI_COLORS['magenta'], ANSI_COLORS['reset'], PHP_EOL);

while (!$file_found) {
    $file = readline();

    $file = substr($file, 0, 2);

    foreach ($files as $key => $file_name) {

        if (str_starts_with($file_name, $file)) {
            $file_found = true;
            $index = $key;
            break;
        }
    }
}

if ($file_found) {
    printf("%s============= Output =============%s%s", ANSI_COLORS['cyan'], ANSI_COLORS['reset'], PHP_EOL);
    require_once $files[$index];
    printf("%s==================================%s%s", ANSI_COLORS['cyan'], ANSI_COLORS['reset'], PHP_EOL);
}
