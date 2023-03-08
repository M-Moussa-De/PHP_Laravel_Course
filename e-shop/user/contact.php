<?php session_start(); ?>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<div class="card-body px-5 py-5 row">
  <div class="col col-md-6 mx-auto bg-light p-4">
    <h3 class="card-title text-left mb-3 text-center">Get in touch with us</h3>

    <?php if (isset($_GET['message']) && $_GET['message']) : ?>
      <div class="alert alert-success py-1">
        Your messages was sent successfully, and we will answer you shortly.
      </div>
    <?php elseif (isset($_GET['message_error']) && $_GET['message_error']) : ?>
      <div class="alert alert-warning py-1">
        Sorry, something went wrong while sending your messages. Please, try again
      </div>
      <?php unset($_SESSION['contact_form_data']); ?>
    <?php endif ?>

    <form method="POST" action="forms/message-process.php" class="cmxform" id="commentForm">
      <fieldset>
        <div class="form-group mb-3">
          <label for="cname" class="form-label">Name (required, at least 2 characters)</label>
          <input id="cname" class="form-control" name="name" type="text" value="<?= htmlspecialchars(trim($_SESSION['contact_form_data']['name'] ?? '')) ?>" autofocus>
          <?php if (isset($_SESSION['contact_errors']['name'])) : ?>
            <small class="text-danger">
              <?= $_SESSION['contact_errors']['name'] ?>
            </small>
          <?php endif; ?>
        </div>
        <div class="form-group mb-3">
          <label for="cemail" class="form-label">E-Mail (required)</label>
          <input id="cemail" class="form-control" type="text" name="email" value="<?= htmlspecialchars(trim($_SESSION['contact_form_data']['email'] ?? '')) ?>">
          <?php if (isset($_SESSION['contact_errors']['email'])) : ?>
            <small class="text-danger">
              <?= $_SESSION['contact_errors']['email'] ?>
            </small>
          <?php endif; ?>
        </div>
        <div class="form-group mb-3">
          <label for="cmessage" class="form-label">Your message (required)</label>
          <textarea id="cmessage" class="form-control" name="message"><?= htmlspecialchars(trim($_SESSION['contact_form_data']['message'] ?? '')) ?></textarea>
          <?php if (isset($_SESSION['contact_errors']['message'])) : ?>
            <small class="text-danger">
              <?= $_SESSION['contact_errors']['message'] ?>
            </small>
          <?php endif; ?>
        </div>
        <input class="btn btn-sm btn-outline-primary mb-3" type="submit" value="Send">
      </fieldset>
    </form>
  </div>
</div>

<?php unset($_SESSION['contact_errors']); ?>

<?php include 'footer.php' ?>