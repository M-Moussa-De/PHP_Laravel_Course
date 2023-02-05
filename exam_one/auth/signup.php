<?php session_start(); ?>
<?php include './../config.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'header.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'navbar.php'; ?>

<?php

if (isset($_SESSION['username'])) {
  header('Location:' . ROOT_PATH);
  exit;
}

$userExists = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $data = [
    'username' => htmlspecialchars(trim($_POST['username'])) ?? '',
    'firstname' => htmlspecialchars(trim($_POST['firstname'])) ?? '',
    'lastname' => htmlspecialchars(trim($_POST['lastname'])) ?? '',
    'email' => htmlspecialchars(trim($_POST['email'])) ?? '',
    'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT) ?? '',
    'type' => 1
  ];

  if (file_exists('./../database/users.json')) {
    $json = json_decode(file_get_contents('./../database/users.json'), true);
  } else {
    $json = ['users' => []];
  }

  // Check if user exists
  foreach ($json['users'] as $user) {
    if ($user['username'] === $data['username'] || $user['email'] === $data['email']) {
      $userExists = true;
      break;
    }
  }

  if (!$userExists) {
    $json['users'][] = (object)$data;

    $file = fopen('./../database/users.json', 'w');

    fwrite($file, json_encode($json));
    fclose($file);

    header('Location:' . ROOT_PATH . DS . 'auth?signedup=true');
    exit;
  }
}

?>

<div class="card-body px-5 py-5">
  <form id="signup-form" method="POST">
    <h3 class="card-title text-center mb-3">Create an account</h3>

    <?php if ($userExists) : ?>
      <div class="alert alert-danger py-1">
        User already exists
      </div>
    <?php endif; ?>

    <div class="row">
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="username" class="form-label">Username *</label>
          <input type="text" id="username" name="username" class="form-control p_input" required autofocus spellcheck="off">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3 mx-1">
          <label for="firstname" class="form-label">Firstname *</label>
          <input type="text" id="firstname" name="firstname" class="form-control p_input" required autofocus spellcheck="off">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="lastname" class="form-label">Lastname *</label>
          <input type="text" id="lastname" name="lastname" class="form-control p_input" required autofocus spellcheck="off">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="email" class="form-label">Email *</label>
          <input type="email" id="email" name="email" class="form-control p_input" required spellcheck="off">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="password" class="form-label">Password *</label>
          <input type="password" id="password" name="password" class="form-control p_input" required>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="phone" class="form-label">Phone</label>
          <input type="tel" id="phone" name="phone" class="form-control p_input" spellcheck="off">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="street" class="form-label">Street</label>
          <input type="text" id="street" name="street" class="form-control p_input" spellcheck="off">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="zip" class="form-label">Zip</label>
          <input type="text" id="zip" name="zip" class="form-control p_input" spellcheck="off">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="mb-3  mx-1">
          <label for="city" class="form-label">City</label>
          <input type="text" id="city" name="city" class="form-control p_input" spellcheck="off">
        </div>
      </div>
    </div>

    <div class="my-3 d-flex align-items-center justify-content-between">
      <div class="row">
        <div class="col-12">
          <div class="text-center">
            <button type="submit" class="btn btn-dark btn-sm btn-block enter-btn">Signup</button>
          </div>
        </div>
        <div class="d-flex my-4">
          <button class="btn btn-facebook col me-2 bg-primary text-white">
            <i class="fab fa-facebook-f"></i> Facebook </button>
          <button class="btn btn-google col bg-danger text-white">
            <i class="fab fa-google-plus"></i> Google plus </button>
        </div>
        <p class="sign-up">Already have an Account?<a href="<?= ROOT_PATH . DS . 'auth' ?>"> Login</a></p>
        <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
      </div>
    </div>
  </form>
</div>


<?php include ROOT_PATH .  DS . 'includes' . DS . 'footer.php'; ?>