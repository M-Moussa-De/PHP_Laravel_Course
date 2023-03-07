<?php include "header.php"; ?>
<?php include "navbar.php"; ?>


<div class="card-body px-5 py-5 row">
  <div class="col col-md-6 mx-auto bg-light p-4">
    <h3 class="card-title text-left mb-3 text-center">Get in touch with us</h3>
    <form class="cmxform" id="commentForm" method="get" action="#" novalidate>
      <fieldset>
        <div class="form-group">
          <label for="cname">Name (required, at least 2 characters)</label>
          <input id="cname" class="form-control" name="name" minlength="2" type="text">
        </div>
        <div class="form-group">
          <label for="cemail">E-Mail (required)</label>
          <input id="cemail" class="form-control" type="email" name="email">
        </div>
        <div class="form-group">
          <label for="curl">Phone (optional)</label>
          <input id="tel" class="form-control" type="url" name="url">
        </div>
        <div class="form-group">
          <label for="ccomment">Your comment (required)</label>
          <textarea id="ccomment" class="form-control" name="comment"></textarea>
        </div>
        <input class="btn btn-sm btn-outline-primary mt-3" type="submit" value="Submit">
      </fieldset>
    </form>
  </div>
</div>

<?php include 'footer.php' ?>