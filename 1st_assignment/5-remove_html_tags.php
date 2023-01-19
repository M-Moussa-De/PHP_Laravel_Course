<?php

$htmlContent = "<h1>PHP track</h1><p> PHP is an interpreted language</p>";

// method 1
// $palin_text_1 = strip_tags($htmlContent);

// method 2
$palin_text_2 = preg_replace('/<[^>]*>/', '', $htmlContent);

printf("%s%s%s%s",  ANSI_COLORS['blue'], $palin_text_2,  ANSI_COLORS['reset'], PHP_EOL);
