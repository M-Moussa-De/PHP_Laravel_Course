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

<?php

if (!isset($_SESSION['admin']) && $_SESSION['admin'] !== 'true') {

  header('Location: ./../../../user');
  exit;
}

?>

<?php

if (!isset($_GET['id'])) {

  header('Location: ./');
  exit;
}

?>


<?php
// Retrieve product
$conn = include './../../../db.php';

// Query the DB to get the wanted product
$id = (int) htmlspecialchars($_GET['id'] ?? '');
$sql = <<<SQL
  SELECT *
  FROM products
  WHERE id = $id
SQL;

$product = $conn->query($sql)->fetch_assoc();
?>

<!-- Delete product -->
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
  $id = $product['id'];
  $sql = <<<SQL
       DELETE FROM products
       WHERE id = $id
  SQL;

  $conn = include './../../../db.php';

  $res = $conn->query($sql);

  if ($res) {
    header('Location: ' . ROOT_PATH . '/pages/products');
    exit;
  }

  echo "<div class='alert alert-warning'> Could not delete product</div>";
}

?>

<?php include "./../../shared/header.php"; ?>

<section style="margin-top: 5rem;">

  <?php if ($product) : ?>
    <div class="card">
      <div class="card-body">
        <?php if (isset($_SESSION['product-added'])) : ?>
          <div class="alert alert-success py-1">
            Product added successfully
            <?php unset($_SESSION['product-added']) ?>
          </div>
        <?php endif; ?>
        <div class="row">

          <div class="col-12 col-md-3 text-center mb-3 mb-md-0">
            <img src="<?= ROOT_PATH . '/../user/img/' . $product['img'] ?>" alt="<?= $product['name'] ?>" height="200" width="200">
          </div>

          <div class="col-12 col-md-8 mx-auto">
            <form method="POST">
              <dl>
                <div class="d-flex">
                  <dt>Name:</dt>
                  <dd class="mx-2"><?= $product['name'] ?></dd>
                </div>
                <div class="d-flex">
                  <dt>Brand:</dt>
                  <dd class="mx-2"><?= $product['brand'] ?></dd>
                </div>
                <div class="d-flex">
                  <dt>Type:</dt>
                  <dd class="mx-2"><?= $product['type'] ?></dd>
                </div>
                <div class="d-flex">
                  <dt>Price:</dt>
                  <dd class="mx-2"><?= $product['price'] ?></dd>
                </div>
                <div class="d-flex">
                  <dt>Stars:</dt>
                  <dd class="mx-2"><?= $product['stars'] ?></dd>
                </div>
                <div class="d-flex">
                  <dt>Created at:</dt>
                  <dd class="mx-2"><?= date('d-m-Y', strtotime($product['created_at'])) ?></dd>
                </div>
                <div class="d-flex">
                  <dt>Updated at:</dt>
                  <dd class="mx-2"><?= date('d-m-Y', strtotime($product['updated_at'])) ?></dd>
                </div>
                <div>
                  <dt>Description:</dt>
                  <dd class="text-muted"><?= $product['description'] ?></dd>
                </div>
              </dl>
              <a class="btn btn-outline-primary text-white" href="<?= ROOT_PATH . '/pages/products/edit.php?id=' . $product['id'] ?>">Update</a>
              <button type="button" data-bs-toggle="modal" data-bs-target="#deleteProduct" class="btn btn-outline-danger text-white">Remove from store</button>
            </form>
          </div>

        <?php else : ?>

          <h4 class="text-muted text-center">No product found</h4>

        <?php endif; ?>
        </div>
      </div>

    </div>


</section>

<!-- Remove product modal -->
<div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProductLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-danger fs-5" id="deleteProductLabel">Delete product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p style="font-size: 1.1rem">Are your sure about deleting this product?</p>
        <small>This action can't be undon</small>
      </div>
      <div class="modal-footer">
        <form method="POST">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<?php include "./../../shared/footer.php"; ?>