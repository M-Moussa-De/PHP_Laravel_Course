<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./');
    exit;
}

$data = [
    "email"     => htmlspecialchars(trim($_POST['email'] ?? '')),
    "password"  => trim($_POST['password'] ?? ''),
];

if (
    empty($data['email']) || empty($data['password']) ||
    !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
) {
    $_SESSION['login_error'] = 'Invalid login';
    $_SESSION['email'] = $data['email'];

    header('Location: ./../login.php');
    exit;
}

$errors = [];

// E-Mail
$email = $data['email'];
$sql = <<<SQL
    SELECT *
    FROM users
    WHERE email = '$email'
    LIMIT 1
SQL;

$conn = include './../../db.php';

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
}

$_SESSION['login_error'] = 'Invalid login';
$_SESSION['email'] = $data['email'];

header('Location: ./../login.php');
exit;
