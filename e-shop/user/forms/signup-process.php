<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./');
    exit;
}

$data = [
    "firstname" => htmlspecialchars(trim($_POST['firstname'] ?? '')),
    "lastname"  => htmlspecialchars(trim($_POST['lastname'] ?? '')),
    "email"     => htmlspecialchars(trim($_POST['email'] ?? '')),
    "password"  => trim($_POST['password'] ?? ''),
    "phone"     => htmlspecialchars(trim($_POST['phone'] ?? '')),
    "address"   => htmlspecialchars(trim($_POST['address'] ?? ''))
];

$errors = [];

// Firstname
if (empty($data['firstname'])) {
    $errors['firstname'] = 'Firstname is required';
} else if (strlen($data['firstname']) < 3) {
    $errors['firstname'] = 'Firstname must be 3 charachters length at least';
}

// Lastname
$conn = include './../../db.php';
// Check if Lastname is in use
$lname = $data['lastname'];
$sql = <<<SQL
    SELECT *
    FROM users
    WHERE lastname = '$lname'
SQL;
$result = $conn->query($sql);

if (empty($data['lastname'])) {
    $errors['lastname'] = 'Lastname is required';
} else if (strlen($data['lastname']) < 3) {
    $errors['lastname'] = 'Lastname must be 3 charachters length at least';
} else if ($result->num_rows > 0) {
    $errors['lastname'] = 'Lastname is in use';
}

// E-Mail
// Check if email is in use
$email = $data['email'];
$sql = <<<SQL
    SELECT *
    FROM users
    WHERE email = '$email'
SQL;
$result = $conn->query($sql);

if (empty($data['email'])) {
    $errors['email'] = 'E-Mail is required';
} else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid E-Mail';
} else if ($result->num_rows > 0) {
    $errors['email'] = 'E-Mail already taken';
}

// Password
if (empty($data['password'])) {
    $errors['password'] = 'Password is required';
} else if (strlen($data['password']) < 3) {
    $errors['password'] = 'Password must be 3 charachters length at least';
}

// Phone
// if ($data['phone']) {
//     var_dump(preg_match('\^[0-9]{11-15}\$', $data['phone']));
//     die;
//     if (!preg_match('\^[0-9]{11-15}\$', $data['phone'])) {
//         $errors['phone'] = 'Phone must contain only digites and should be between 11 and 15 digites length';
//     }
// }

// After Validation
if (!empty($errors)) {

    $_SESSION['signup_errors'] = $errors;

    $_SESSION['signup_form_data'] = $data;

    header('Location: ./../signup.php');
    exit;
}

// Build query
$sql = 'INSERT INTO users (firstname, lastname, email, password';

if (!empty(($data['phone']))) {
    $sql .= ', phone';
}

if (!empty(($data['address']))) {
    $sql .= ', address';
}

$sql .= ') VALUES (?, ?, ?, ?';

if (!empty(($data['phone']))) {
    $sql .= ', ?';
}

if (!empty(($data['address']))) {
    $sql .= ', ?';
}

$sql .= ')';

// Save into DB
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'ssss', $data['firstname'], $data['lastname'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT));

if (!empty($data['phone'])) {
    mysqli_stmt_bind_param($stmt, 's', $data['phone']);
}

if (!empty($data['address'])) {
    mysqli_stmt_bind_param($stmt, 's', $data['address']);
}

if (mysqli_stmt_execute($stmt)) {

    header('Location: ./../login.php/?signedup=true');
    exit;
} else {

    header('Location: ./../signup.php?signup_error=true');
    exit;
}
