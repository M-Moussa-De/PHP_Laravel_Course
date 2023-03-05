<?php session_start(); ?>
<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<?php

if (isset($_SESSION['user_id'])) {
  header('Location: ./');
  exit;
}
?>

<?php

$login_error = '';

if (isset($_SESSION['login_error'])) {
  $login_error = $_SESSION['login_error'];
  $data = $_SESSION['email'];

  unset($_SESSION['login_error']);
  unset($_SESSION['email']);
}

?>

<div class="card-body px-5 py-5 row">
  <div class="col col-md-6 mx-auto bg-light p-4">
    <h3 class="card-title text-left mb-3 text-center text-muted">Login</h3>
    <form method="POST" action="forms/login-process.php" class="text-muted">

      <?php if (isset($login_error)) : ?>
        <small class="text-danger d-block mb-2"><?= $login_error ?></small>
      <?php endif; ?>
      <div class="mb-3">
        <label for="email" class="form-label">E-Mail *</label>
        <input type="text" name="email" class="form-control p_input" id="email" value="<?= $data['email'] ?? '' ?>" autofocus>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password *</label>
        <input type="password" name="password" id="password" class="form-control p_input" id="password">
      </div>
      <div class="form-group d-flex align-items-center justify-content-between">
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input">Remember me</label>
        </div>
        <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
      </div>
      <div class="text-center">
        <button name="login-btn" type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
      </div>
      <p class="text-muted">Don't have an Account?<a href="signup.php">Sign Up</a></p>
    </form>
  </div>
</div>

<?php include "footer.php" ?>