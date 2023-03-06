<?php

$included_files = get_included_files();
$included = false;

foreach ($included_files as $file) {
  $file_name = basename($file);
  if ($file_name == 'config.php') {
    $included = true;
    break;
  }
}

if (!$included) {
  include './../../config.php';
}


?>

</div>
<!-- /. content-wrapper -->

<!-- footer.php -->
<footer class="footer">
  <span class="text-muted">Copyright © M&M 2023</span>
</footer>
<!-- /. footer.php -->

</div>
<!-- /. main-panel -->

</div>
<!-- ./ page-body-wrapper -->

</div>
<!-- /. container-scroller -->

<!-- plugins:js -->
<script src="<?= ROOT_PATH . '/assets/vendors/js/vendor.bundle.base.js' ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="<?= ROOT_PATH . '/assets/vendors/chart.js/Chart.min.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/vendors/progressbar.js/progressbar.min.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/vendors/jvectormap/jquery-jvectormap.min.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/vendors/owl-carousel-2/owl.carousel.min.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/js/jquery.cookie.js' ?>" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= ROOT_PATH . '/assets/js/off-canvas.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/js/hoverable-collapse.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/js/misc.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/js/settings.js' ?>"></script>
<script src="<?= ROOT_PATH . '/assets/js/todolist.js' ?>"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="<?= ROOT_PATH . '/assets/js/dashboard.js' ?>"></script>
<!-- End custom js for this page -->
</body>

</html>