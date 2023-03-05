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

if (isset($_SESSION['signup_errors'])) {
  $errors = $_SESSION['signup_errors'];
  $data = $_SESSION['signup_form_data'];

  unset($_SESSION['signup_errors']);
  unset($_SESSION['signup_form_data']);
}
?>

<div class="card-body px-5 py-5 row">
  <div class="col col-md-6 mx-auto bg-light p-4">
    <h3 class="card-title text-left mb-3 text-center">Create a new account</h3>
    <form method="POST" action="forms/signup-process.php" novalidate>
      <div class="mb-3">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" name="firstname" id="firstname" class="form-control p_input" placeholder="John" value="<?= $data['firstname'] ?? '' ?>" autofocus>
        <?php if (isset($errors['firstname'])) : ?>
          <small class="text-danger">
            <?= $errors['firstname'] ?>
          </small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" name="lastname" id="lastname" class="form-control p_input" placeholder="Doe" value="<?= $data['lastname'] ?? '' ?>">
        <?php if (isset($errors['lastname'])) : ?>
          <small class="text-danger">
            <?= $errors['lastname'] ?>
          </small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control p_input" placeholder="john@doe.com" value="<?= $data['email'] ?? '' ?>">
        <?php if (isset($errors['email'])) : ?>
          <small class="text-danger">
            <?= $errors['email'] ?>
          </small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control p_input" placeholder="Enter a password">
        <?php if (isset($errors['password'])) : ?>
          <small class="text-danger">
            <?= $errors['password'] ?>
          </small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control p_input" placeholder="00123456789" value="<?= $data['phone'] ?? '' ?>">
        <?php if (isset($errors['phone'])) : ?>
          <small class="text-danger">
            <?= $errors['phone'] ?>
          </small>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" name="address" id="address" class="form-control p_input" placeholder="Main St 111, City 12345" value="<?= $data['address'] ?? '' ?>">
      </div>
      <div class="text-center">
        <button type="submit" name="signup-btn" class="btn btn-primary btn-block enter-btn mt-2">Signup</button>
      </div>
      <div class="mb-3">
        <p class="my-1 text-muted">Already have an Account?<a href="login.php"> Login</a></p>
        <p class="my-1 text-muted">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
      </div>
    </form>
  </div>
</div>

<?php include "footer.php" ?>