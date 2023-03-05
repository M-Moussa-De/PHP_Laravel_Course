<?php include './config.php' ?>

<?php

if (!isset($_SESSION['admin']) || !isset($_SESSION['id'])) {

  header('Location: ./../user');
  exit;
}

?>

<?php include ROOT_PATH . '/shared/header.php' ?>

<!-- row -->
<div class="row">

  <div class="col-md-6 mx-auto grid-margin stretch-card">

    <!-- Content goes here -->

  </div>

</div>
<!-- /. row -->

<?php include ROOT_PATH . '/shared/footer.php'; ?>