<?php

include './../config.php';

$item_id = $_POST['item_id'];

foreach ($_SESSION['cart'] as $key => $item) {
  if ($item['id'] == $item_id) {
    unset($_SESSION['cart'][$key]);
    break;
  }
}

header('Location:' . ROOT_PATH . DS . 'pages');
exit;
