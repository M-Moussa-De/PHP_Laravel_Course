<?php include './../config.php'; ?>
<?php include './../includes/header.php'; ?>
<?php include './../includes/navbar.php'; ?>
<?php include './../functions/processLogin.php'  ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && processLogin()) {
  session_regenerate_id();
  header('Location:' . ROOT_PATH . ($user['type'] === 0 ? DS . 'admin' : ''));
  exit;
}
?>

<div class="card-body px-5 py-5">
  <form id="login-form" method="POST">
    <h3 class="card-title text-center mb-4">Login</h3>

    <?php if (isset($_GET['signedup'])) : ?>
      <div class="alert alert-success py-1">
        Signed up successfully. You can login now!
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['loggedout'])) : ?>
      <div class="alert alert-success py-1">
        Logged out successfully!
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['loggin_required'])) : ?>
      <div class="alert alert-success py-1">
        Login first to complete checking out
      </div>
    <?php endif; ?>

    <div class="mb-3">
      <label for="email" class="form-label">Username/Email *</label>
      <input type="text" name="email" id="email" class="form-control p_input" required autofocus spellcheck="off">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password *</label>
      <input type="password" name="password" id="password" class="form-control p_input" required>
    </div>
    <div class="form-group d-flex align-items-center justify-content-between">
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input">Remember me</label>
      </div>
      <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-dark btn-sm btn-block enter-btn">Login</button>
    </div>
    <p class="sign-up">Don't have an Account?<a href="<?= ROOT_PATH . DS . 'auth' . DS . 'signup.php' ?>"> Sign Up</a></p>
    <div class="d-flex mt-4">
      <button class="btn btn-facebook me-2 col bg-primary text-white">
        <i class="fab fa-facebook-f"></i> Facebook </button>
      <button class="btn btn-google col bg-danger text-white">
        <i class="fab fa-google-plus"></i> Google plus </button>
    </div>
  </form>
</div>


<?php include './../includes/footer.php'; ?>