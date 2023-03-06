<?php include './config.php'; ?>

<?php

if (!isset($_SESSION['admin']) && $_SESSION['admin'] !== 'true') {

  header('Location: ./../user');
  exit;
}

?>

<?php include './shared/header.php' ?>

<!-- row -->
<div class="row">

  <div class="col-md-6 mx-auto grid-margin stretch-card">

    <!-- Content goes here -->

  </div>

</div>
<!-- /. row -->

<?php include './shared/footer.php'; ?>