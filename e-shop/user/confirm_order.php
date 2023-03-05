<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./cart.php');
    exit;
}

unset($_SESSION['cart']);
?>

<?php
include "header.php";
include "navbar.php";

?>


<section>

    <h2 class="text-center text-muted" style="padding: 10.5rem;">Thank you for your order</h2>

</section>


<?php include "footer.php" ?>