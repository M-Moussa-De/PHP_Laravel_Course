<?php

function getPriceWithDiscount($price): float
{
    try {

        if (!is_numeric($price)) {
            throw new Exception("Please, enter a numeric value");
        }

        $dicount = $price > 1000 ? 0.1 : 0.05;

        $price_after_discount = sprintf('%.2f', $price - ($price * $dicount));

        return $price_after_discount;
    } catch (Exception $e) {
        printf("%s%s%s ", ANSI_COLORS['red'], $e->getMessage(), ANSI_COLORS['reset'], PHP_EOL);
        return 0;
    }
}

printf("%s%s%s%s", ANSI_COLORS['blue'], getPriceWithDiscount(1570), ANSI_COLORS['reset'], PHP_EOL);
