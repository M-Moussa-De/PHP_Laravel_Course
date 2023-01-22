<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    $name = htmlspecialchars(trim($_POST["name"])) ?? '';
    $description =  htmlspecialchars(trim($_POST["description"])) ?? '';
    $price = htmlspecialchars(trim($_POST["price"])) ?? 0;

    if (empty($name)) {
        $errors[] = "Name is required";
    } else if (!is_string($name)) {
        $errors[] = "Name must be a string";
    } else if (strlen($name) < 5) {
        $errors[] = "Name must be at least 5 characters";
    } else if (strlen($name) > 255) {
        $errors[] = "Name must be at most 255 characters";
    }

    if (!is_numeric($price)) {
        $errors[] = "Price must be a number";
    } else if ($price < 0) {
        $errors[] = "Price must be greater than or equal to 0";
    }

    if (empty($errors)) {
        echo "Name: $name<br />";

        if (!empty($description)) {
            echo "Description: $description<br />";
        }

        echo "Price: $price<br />";
        echo "Price with discount: " . getPriceAfterDiscount($price) . "<br />";
    } else {
        foreach ($errors as $error) {
            echo "$error<br />";
        }
    }
}

function getPriceAfterDiscount(float $price): float
{
    return $price - ($price * 0.9);
}
