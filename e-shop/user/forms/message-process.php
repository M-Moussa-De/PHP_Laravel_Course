<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./');
    exit;
}

$data = [
    "name" => htmlspecialchars(trim($_POST['name'] ?? '')),
    "email"     => htmlspecialchars(trim($_POST['email'] ?? '')),
    "message"  => htmlspecialchars(trim($_POST['message'] ?? ''))
];

$errors = [];

// Name
if (empty($data['name'])) {
    $errors['name'] = 'Name is required';
} else if (strlen($data['name']) < 2) {
    $errors['name'] = 'Name must be 2 charachters length at least';
}

// E-Mail
if (empty($data['email'])) {
    $errors['email'] = 'E-Mail is required';
} else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid E-Mail';
}

// E-Mail
if (empty($data['message'])) {
    $errors['message'] = 'Message is required';
}

// After Validation
if (!empty($errors)) {

    $_SESSION['contact_errors'] = $errors;

    $_SESSION['contact_form_data'] = $data;

    header('Location: ./../contact.php');
    exit;
} else {

    $sql = <<<SQL
    INSERT INTO messages (name, email, comment)
    VALUES (?, ?, ?)
SQL;

    // Save into DB
    $conn = include './../../db.php';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $data['name'], $data['email'], $data['message']);

    if (mysqli_stmt_execute($stmt)) {

        header('Location: http://e-shop.localhost/user/contact.php?message=true');
        exit;
    } else {

        header('Location: ./../contact.php?message_error=true');
        exit;
    }
}
