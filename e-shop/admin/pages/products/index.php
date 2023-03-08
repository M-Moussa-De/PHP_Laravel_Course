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
// Retrieve products

$conn = include './../../../db.php';

// Pagination system
$items_per_page = 5;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $items_per_page;

// Query the DB to count the total number of products
$sql2 = <<<SQL
  SELECT COUNT(*) AS count
  FROM products
SQL;

$count_result = $conn->query($sql2)->fetch_assoc();

// Calculate the total number of pages
$total_pages = (int)ceil($count_result['count'] / $items_per_page);

// Retrieve products depending on according to the pagination system
$sql = <<<SQL
  SELECT *
  FROM products
  LIMIT $items_per_page OFFSET $offset
SQL;

$res = $conn->query($sql);

if ($res->num_rows > 0) {

  $products = $res->fetch_all(MYSQLI_ASSOC);
}

?>

<?php include "./../../shared/header.php"; ?>

<div class="row" style="margin-top: 5rem;">

  <?php if ($products) : ?>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">All products</h4>

        <!-- Table data -->
        <div class="row">
          <div class="col-12">
            <div class="table-responsive">
              <table id="products-table" class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stars</th>
                    <th>Type</th>
                    <th>Added at</th>
                    <th>Updated at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="product-list">
                  <?php foreach ($products as $product) : ?>
                    <tr>
                      <td><?= $product['name'] ?></td>
                      <td><?= $product['brand'] ?></td>
                      <td>
                        <?php
                        $res = $conn->query('SELECT DISTINCT(name) FROM categories WHERE id = ' . $product['cat_id'])->fetch_assoc();
                        ?>
                        <?= $res['name'] ?>
                      </td>
                      <td><?= $product['price'] ?></td>
                      <td><?= $product['stars'] ?></td>
                      <td><?= $product['type'] ?></td>
                      <td><?= $product['created_at'] ?></td>
                      <td><?= $product['updated_at'] ?></td>
                      <?php if ($product) : ?>
                        <td>
                          <a class="btn btn-outline-primary" href="<?= './show.php/?id=' . $product['id'] ?>">View</a>
                        </td>
                      <?php endif ?>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /. Table data -->

        <!-- Modals -->
        <?php foreach ($products as $product) : ?>
          <div class="modal fade" id="product-<?= $product['id'] ?>" tabindex="-1" aria-labelledby="product-<?= $product['id'] ?>-label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 style="font-size: 1rem !important" class="modal-title fs-5" id="product-<?= $product['id'] ?>-label"><?= $product['name'] ?></h1>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                  <p style="font-size: 0.9rem !important; color: #eee;"><?= substr($product['description'], 0, 300) ?></p>
                </div>
                <div class=" modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Edite</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>


        <!-- Pagination -->
        <div class="row">
          <div class="col-12">
            <div class="d-flex justify-content-between pt-3">
              <div style="font-size: 0.875rem;">
                Showing <?= ($offset + 1) .  " to " . min($offset + $items_per_page, $count_result['count']) . " of " . $count_result['count'] .  " entries" ?>
              </div>
              <nav aria-label="Page navigation">
                <ul id="pagination-links" class="pagination justify-content-center">
                  <li class="<?= 'page-item ' . ($current_page == 1 ? 'disabled' : '') ?>">
                    <a class="page-link" href="<?= '?page=' . ($current_page - 1) ?>" tabindex="<?= -1 ?>">Previous</a>
                  </li>

                  <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="<?= 'page-item ' . ($i == $current_page ? 'active' : '') ?>">
                      <a class="page-link" href="<?= '?page=' . $i ?>"> <?= $i ?></a>
                    </li>
                  <?php endfor; ?>

                  <li class="<?= 'page-item ' . ($current_page == $total_pages ? 'disabled' : '') ?>">
                    <a class="page-link" href="<?= '?page=' . ($current_page + 1) ?>">Next</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <!-- ./ Pagination -->

      </div>
    </div>

  <?php else : ?>

    <center class="mt-5">No available products</center>

  <?php endif; ?>

</div>

<?php include "./../../shared/footer.php"; ?>