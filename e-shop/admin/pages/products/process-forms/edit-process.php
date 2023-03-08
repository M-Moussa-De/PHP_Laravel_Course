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
    "type"  => htmlspecialchars(trim($_POST['type'] ?? '')),
    "img"       => $_FILES['img'] ?? '',
    "price"     => htmlspecialchars(trim($_POST['price'] ?? '')),
];

$errors = [];

// Name
if (empty($data['name'])) {
    $errors['name'] = 'Name is required';
} else if (strlen($data['name']) < 2) {
    $errors['name'] = 'Name must be 2 charachters length at least';
}

// Brand
if (empty($data['brand'])) {
    $errors['brand'] = 'Brand is required';
} else if (strlen($data['brand']) < 2) {
    $errors['brand'] = 'Brand must be 2 charachters length at least';
}

// Category
if (empty($data['category'])) {
    $errors['category'] = 'Category is required, and if there are no available categories, create one';
}

// Category
if (empty($data['type'])) {
    $errors['type'] = 'Type is required,and if there are no available types, create one';
}

// Image
$img = $data['img'] ?? '';

if (!$img['size']) {
    $errors['img'] = 'Image is required';
}

// Price
if (empty($data['price'])) {
    $errors['price'] = 'Price is required';
}

if ($errors) {

    $_SESSION['data'] = $data;
    $_SESSION['add-errors'] = $errors;

    header('Location: ./../new.php');
    exit;
}

// Add product into DB
$conn = include './../../../../db.php';
$t = $data['type'];
$type = <<<SQL
   SELECT *
   FROM products
   WHERE id = '$t'
SQL;

$pro_type = $conn->query($type)->fetch_assoc();

$sql = <<<SQL
  INSERT INTO products (cat_id, name, brand, price, img, type)
  VALUES (?, ?, ?, ?, ?, ?)
SQL;

$target_dir = './../../../../user/img/products/';
$target_file = $target_dir . basename($img['name']);

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $img = 'products/' . $data['img']['name'];
    mysqli_stmt_bind_param(
        $stmt,
        'ssssss',
        $data['category'],
        $data['name'],
        $data['brand'],
        $data['price'],
        $img,
        $pro_type['type']
    );

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['product-added'] = true;

        header('Location: ./../new.php');
        exit;
    }
}
//  else {

//     $error_message = mysqli_error($conn);

//     echo $error_message;
// }
