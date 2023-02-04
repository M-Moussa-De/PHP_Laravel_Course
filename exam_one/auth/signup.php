<?php include './../config.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'header.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'navbar.php'; ?>


<div class="card-body px-5 py-5">
  <form id="signup-form" method="POST">
    <h3 class="card-title text-center mb-3">Create an account</h3>
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" id="username" name="username" class="form-control p_input" required autofocus spellcheck="off">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" id="email" name="email" class="form-control p_input" required spellcheck="off">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" id="password" name="password" class="form-control p_input" required>
    </div>
    <div class="mb-3">
      <label for="phone" class="form-label">Phone</label>
      <input type="tel" id="phone" name="phone" class="form-control p_input" spellcheck="off">
    </div>
    <div class="mb-3">
      <label for="address" class="form-label">Address</label>
      <input type="text" id="address" name="address" class="form-control p_input" spellcheck="off">
    </div>

    <div class="mb-3 d-flex align-items-center justify-content-between">
      <div class="form-check">

        <div class="text-center">
          <button type="submit" class="btn btn-dark btn-sm btn-block enter-btn">Signup</button>
        </div>
        <div class="d-flex mt-4">
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