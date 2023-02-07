<?php include './../config.php'; ?>
<?php include ROOT_PATH . DS . 'includes' . DS . 'header.php'; ?>
<?php include ROOT_PATH . DS . 'includes' . DS . 'navbar.php'; ?>

<?php

if (!isset($_SESSION['username'])) {
  header('Location: ' .  ROOT_PATH . DS . 'auth?loggin_required=true');
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



<?php include ROOT_PATH . DS . 'includes' . DS . 'footer.php'; ?>