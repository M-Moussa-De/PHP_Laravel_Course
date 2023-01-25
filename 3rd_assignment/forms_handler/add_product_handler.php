<?php

session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']) ?? '';
    $quantity = intval(htmlspecialchars($_POST['quantity']) ?? 0);
    $img = $_FILES['img'] ?? '';
    $price = htmlspecialchars($_POST['price']) ?? 0;

    if (strlen($title) < 4 || strlen($title) > 255) {
        $errors['title'] = 'Title must be between 4 and 255 charachters length';
    }

    $fileExtension = pathinfo($img['name'], PATHINFO_EXTENSION);

    if ($img['size'] < 50) {
        $errors['img'] = 'Image is required and must be 50 kb at least';
    } else if (
        $fileExtension !== 'jpeg' &&
        $fileExtension !== 'png' &&
        $fileExtension !== 'jpg'
    ) {
        $errors['img'] = 'Image extensions must be one of (jpeg, png or jpg)';
    }

    if (count($errors) === 0) {

        $img['name'] = $title . "." . $fileExtension;
        move_uploaded_file($img["tmp_name"], "uploads/" . $img["name"]);

        $_SESSION['products'][] = [
            'id' => time(),
            'title' => $title,
            'quantity' => $quantity,
            'img' => "./uploads/" . $img['name'],
            'price' => $price,
        ];

        header('Location: products.php');
        exit;
    }
}
