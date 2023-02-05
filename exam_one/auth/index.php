<?php session_start(); ?>
<?php include './../config.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'header.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'navbar.php'; ?>

<?php

if (isset($_SESSION['username'])) {
  header('Location:' . ROOT_PATH);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Clear the signedup key from the url
  // in order to remove the success alert
  if (isset($_GET["signedup"])) {
    unset($_GET["signedup"]);
  }
  $url = basename($_SERVER['PHP_SELF']);
  $query = http_build_query($_GET);
  if (!empty($query)) {
    $url .= "?" . $query;
  }
  header("Location: " . ROOT_PATH . DS . 'auth');

  $data = [
    'email' => htmlspecialchars(trim($_POST['email'])) ?? '',
    'password' => trim($_POST['password']) ?? ''
  ];

  if (file_exists('./../database/users.json')) {
    $json = json_decode(file_get_contents('./../database/users.json'), true);
  } else {
    $json = ['users' => []];
  }

  // Check if user exists
  foreach ($json['users'] as $user) {
    if ((isset($user['username']) && $user['username'] === $data['email']) ||
      (isset($user['email']) && $user['email'] === $data['email'])
    ) {
      if (password_verify($data['password'], $user['password'])) {


        $_SESSION['username'] = $user['username'];
        session_regenerate_id();

        header('Location:' . ROOT_PATH);
        exit;
      }
    }
  }
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


<?php include ROOT_PATH .  DS . 'includes' . DS . 'footer.php'; ?>