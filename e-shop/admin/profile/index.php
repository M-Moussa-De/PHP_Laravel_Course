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
  include './../config.php';
}

?>

<?php

if (!isset($_SESSION['admin']) && $_SESSION['admin'] !== 'true') {

  header('Location: ./../../user');
  exit;
}

?>

<?php

// Retrieve admin info
$id = $_SESSION['id'];
$sql = <<<SQL
 SELECT *
 FROM users
 WHERE type = 1
 AND id = $id
 LIMIT 1
SQL;

$conn = include './../../db.php';
$found = false;

$admin = $conn->query($sql)->fetch_assoc();

if ($admin) {
  $found = true;
}
?>

<?php
// Update profile
$errors = [];
$nothing_to_update = false;
$updated = false;
$error_saving_updates = false;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {

  $data = [
    "password"  => trim($_POST['password'] ?? ''),
    "phone"     => htmlspecialchars(trim($_POST['phone'] ?? '')),
    "address"   => htmlspecialchars(trim($_POST['address'] ?? '')),
    "img"   => $_FILES['profile_img'] ?? '',
    "bio"   => htmlspecialchars(trim($_POST['bio'] ?? '')),
  ];

  $sql = '';

  if (empty($data['password']) && empty($data['phone']) && empty($data['address']) && $data['img']['size'] == 0 && empty($data['bio'])) {

    $nothing_to_update = true;
  } else {

    $sql = 'UPDATE users SET ';
    $flage = false;

    if ($data['password']) {

      if (strlen($data['password']) < 3) {
        $errors['password'] = 'Password must be 3 charachters length at least';
      } else {
        $pass = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql .= 'password = ' . $pass;
        $flage = true;
      }
    }

    // Phone
    if ($data['phone']) {
      $phone = $data['phone'];
      $phone = mysqli_real_escape_string($conn, $phone);
      $sql .=  $flage ? ", phone = '$phone'" : " phone = '$phone'";
      $flage = true;
    }

    // Address
    if ($data['address']) {
      if (strlen($data['address']) < 5) {
        $errors['address'] = 'Address must be 5 charachters length at least';
      } else {
        $address = $data['address'];
        $address = mysqli_real_escape_string($conn, $address);
        $sql .=  $flage ? ", address = '$address'" :  " address =  '$address'";
        $flag = true;
      }
    }

    // Bio
    if ($data['bio']) {
      $bio = $data['bio'];
      $bio = mysqli_real_escape_string($conn, $bio);
      $sql .=  $flage ? ", bio = '$bio'"  :  " bio = '$bio'";
    }


    // Image
    $img = false;
    if ($data['img']['size'] > 0) {
      $name = $data['img']['name'];
      $name = mysqli_real_escape_string($conn, $name);
      $sql .= $flage ? ", img = '/profile_imgs/$name'" : " img = '/profile_imgs/$name'";
      $img = true;
    }

    $sql .= " WHERE id = " . $_SESSION['id'] . " AND " . " type = " . 1 . ";";

    // echo $sql;
    // die;

    $conn = include './../../db.php';
    $res = $conn->query($sql);

    if ($res) {
      $updated = true;
      if ($img) {
        $name = $data['img']['name'];
        $from = $data['img']['tmp_name'];
        $to = __DIR__ . '/../../user/img/profile_imgs/' . $name;

        move_uploaded_file($from, $to);
      }
    } else {

      $error_saving_updates = mysqli_error_list($conn);
    }
  }
}

?>

<?php include "./../shared/header.php"; ?>

<section style="margin-top: 5rem;">
  <?php if ($found) : ?>

    <div class="card">
      <div class="card-body">

        <!-- Notifications -->
        <?php if ($updated) : ?>
          <div class="alert alert-success py-1 mx-auto w-50 mb-5">Profile updated successfully</div>
          <?php $updated = null ?>
        <?php elseif ($nothing_to_update) : ?>
          <div class="alert alert-warning py-1 mx-auto w-50 mb-5">Nothing to update</div>
          <?php $nothing_to_update = null ?>
        <?php elseif ($error_saving_updates && isset($error_saving_updates['error'])) : ?>
          <div class="alert alert-warning py-1 mx-auto w-50 mb-5">
            <?= $error_saving_updates['error'] ?>
            <?php $error_saving_updates = null ?>
          </div>
          <?php $nothing_to_update = '' ?>
        <?php endif; ?>
        <!-- ./ Notifications -->

        <div class="row">

          <div class="col-12 col-md-6">
            <div class="text-center">
              <?php if ($admin['img']) : ?>
                <img src="<?= '/user/img' . $admin['img'] ?>" alt="profile" class="img-lg rounded-circle mb-3" />
              <?php else : ?>
                <img src="<?= '/user/img/profiles_imgs/default.png' ?>" alt="profile" class="img-lg rounded-circle mb-3" />
              <?php endif ?>
              <p class="text-muted"><?= $admin['bio'] ?? 'No bio yet, update your profile' ?></p>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="py-4">
              <p class="clearfix">
                <span class="float-left"> Name </span>
                <span class="float-right text-muted"> <?= $admin['firstname'] . ' ' . $admin['lastname'] ?> </span>
              </p>
              <p class="clearfix">
                <span class="float-left"> Status </span>
                <span class="float-right text-muted"> <?= $admin['is_active'] ? 'Active' : 'Not active' ?> </span>
              </p>
              <p class="clearfix">
                <span class="float-left"> Mail </span>
                <span class="float-right text-muted"> <?= $admin['email'] ?> </span>
              </p>
              <p class="clearfix">
                <span class="float-left"> Address </span>
                <span class="float-right text-muted"> <?= $admin['address'] ?? 'Undefind' ?> </span>
              </p>
              <p class="clearfix">
                <span class="float-left"> Phone </span>
                <span class="float-right text-muted"><?= $admin['phone'] ?? 'Undefind' ?></span>
              </p>
            </div>
          </div>

        </div>
        <div class="text-center">
          <button type="button" data-bs-toggle="modal" data-bs-target="#updateProfile" class="btn btn-outline-primary">Update</button>
        </div>

      </div>
    </div>


  <?php else : ?>

    <center>No user record found</center>

  <?php endif; ?>

</section>

<!-- Update profile modal -->
<div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="updateProfileLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" novalidate enctype="multipart/form-data">
        <div class="modal-header">
          <h3 class="modal-title fs-5 mx-auto" id="updateProfileLabel">Update profile</h3>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="firstname" class="form-label">Firstname</label>
            <input type="text" name="firstname" id="firstname" class="form-control p_input bg-transparent" placeholder="John" value="<?= $admin['firstname'] ?? '' ?>" disabled>
          </div>
          <div class="mb-3">
            <label for="lastname" class="form-label">Lastname</label>
            <input type="text" name="lastname" id="lastname" class="form-control p_input bg-transparent" placeholder="Doe" value="<?= $admin['lastname'] ?? '' ?>" disabled>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control p_input bg-transparent" placeholder="john@doe.com" value="<?= $admin['email'] ?? '' ?>" disabled>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control p_input" placeholder="Enter a password">
            <small class="text-info">Leave empty if you want to keep the old</small>
            <?php if (isset($errors['password'])) : ?>
              <small class="text-danger">
                <?= $errors['password'] ?>
              </small>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control p_input" placeholder="00123456789" value="<?= $admin['phone'] ?? '' ?>">
            <?php if (isset($errors['phone'])) : ?>
              <small class="text-danger">
                <?= $errors['phone'] ?>
              </small>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control p_input" placeholder="Main St 111, City 12345" value="<?= $admin['address'] ?? '' ?>">
            <?php if (isset($errors['address'])) : ?>
              <small class="text-danger">
                <?= $errors['address'] ?>
              </small>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="profile_img" class="form-label">Image</label>
            <input type="file" name="profile_img" id="profile_img" class="form-control p_input">
          </div>
          <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" class="w-100 bg-transparent text-light"><?= $admin['bio'] ?? '' ?></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include "./../shared/footer.php"; ?>