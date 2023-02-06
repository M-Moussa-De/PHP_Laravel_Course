<?php include './../config.php'; ?>
<?php include './../includes/header.php'; ?>
<?php include './../includes/navbar.php'; ?>

<?php

if (!isset($_SESSION['username'])) {
  header('Location: http://localhost:8080/projects/php_laravel_course/exam_one/auth?loggin_required=true');
  exit;
}

unset($_SESSION['cart']);

// Create ID for the order
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$id = '';
for ($i = 0; $i < 10; $i++) {
  $id .= $characters[rand(0, strlen($characters) - 1)];
}


?>

<main class="text-center mt-5">

  <h4>Thank you for your ordering</h4>
  <h6 class="text-muted">Your order is completet</h6>
  <p>Order id: <?= $id; ?></p>

</main>



<?php include './../includes/header.php'; ?>