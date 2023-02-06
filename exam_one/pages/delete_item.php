<?php
session_start();

$item_id = $_POST['item_id'];

unset($_SESSION['cart'][$item_id]);

header('Location: cart.php');
exit;
