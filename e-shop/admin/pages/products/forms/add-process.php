<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./..');
    exit;
}

$data = [
    "name"      => htmlspecialchars(trim($_POST['name'] ?? '')),
    "brand"     => htmlspecialchars(trim($_POST['brand'] ?? '')),
    "category"  => htmlspecialchars(trim($_POST['category'] ?? '')),
    "img"       => $_FILES['img'] ?? '',
    "price"     => $_POST['price'] ?? '',
];


$errors = [];

// Name
if (empty($data['name'])) {
    $errors['name'] = 'Name is required';
} else if (strlen($data['name']) < 2) {
    $errors['name'] = 'Name must be 2 charachters length at least';
}

$conn = include './../../../user/db.php';

// Brand
if (empty($data['brand'])) {
    $errors['brand'] = 'brand is required';
} else if (strlen($data['brand']) < 2) {
    $errors['brand'] = 'Brand must be 2 charachters length at least';
}

// Category
if (empty($data['category'])) {
    $errors['category'] = 'Category is required';
}

// Price
if (empty($data['price'])) {
    $errors['price'] = 'Price is required';
}

// echo '<pre>';
// var_dump($data);
// echo '</pre>';
// die;

$errors = [];

// E-Mail
$email = $data['email'];
$sql = <<<SQL
    SELECT *
    FROM users
    WHERE email = '$email'
    LIMIT 1
SQL;

$conn = include './../db.php';

$user = $conn->query($sql)->fetch_assoc();

if ($user) {
    if (password_verify($data['password'], $user['password'])) {

        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['firstname'];

        if ($user['type'] == 1) {
            $_SESSION['admin'] = true;
            session_regenerate_id();

            header('Location: ./../../admin');
            exit;
        } else {

            session_regenerate_id();
            header('Location: ./..');
            exit;
        }
    }
} else {

    $_SESSION['login_error'] = 'Invalid login';
    $_SESSION['email'] = $data['email'];

    header('Location: ./../login.php');
    exit;
}
