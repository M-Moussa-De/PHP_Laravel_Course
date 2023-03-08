<?php

if (!isset($_GET['id'])) {
    header('Location: ./');
    exit;
}

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

// Retrive categories
$conn = include './../../../db.php';

$sql = <<<SQL
  SELECT id, name
  FROM categories
SQL;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cat = $result->fetch_all(MYSQLI_ASSOC);
}

// Retive type
$sql = <<<SQL
  SELECT DISTINCT(type)
  FROM products
SQL;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = $result->fetch_all(MYSQLI_ASSOC);
}

// Retrieve a product
$id = (int)$_GET['id'];
$sql = <<<SQL
  SELECT *
  FROM products
  WHERE id = $id
  LIMIT 1
SQL;

$product = $conn->query($sql)->fetch_assoc();
$found = false;

if ($product) {

    $found = true;
}
?>

<?php include "./../../shared/header.php"; ?>

<!-- row -->
<div class="row" style="margin-top: 5rem;">

    <div class="col-md-6 mx-auto grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <?php if (isset($_SESSION['product-added'])) : ?>
                    <div class="alert alert-success py-1">
                        Product updated successfully
                        <?php unset($_SESSION['product-added']) ?>
                    </div>
                <?php endif; ?>
                <h4 class="card-title text-center">Edit product</h4>
                <!-- Update product -->
                <form action="<?= ROOT_PATH . '/pages/products/process-forms/edit-process.php' ?>" id="addProduct" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Product name</label>
                        <input type="text" class="form-control" name="name" id="product_name" value="<?= $product['name'] ?? '' ?>" placeholder="Product name">
                        <?php if (isset($_SESSION['add-errors']['name'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['name'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="product_brand">Product brand</label>
                        <input type="text" class="form-control" name="brand" id="product_brand" value="<?= $product['brand'] ?? '' ?>" placeholder="Product brand">
                        <?php if (isset($_SESSION['add-errors']['brand'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['brand'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option disabled selected>Choose a category</option>
                            <?php if (isset($cat)) : ?>
                                <?php foreach ($cat as $c) : ?>
                                    <option value="<?= $c['id'] ?>" <?= ($c['id'] == $product['cat_id']) ? 'selected' : '' ?>>
                                        <?= strtoupper($c['name'][0]) . substr($c['name'], 1) ?>
                                    </option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                        <?php if (isset($_SESSION['add-errors']['category'])) : ?>
                            <small class=" text-danger">
                                <?= $_SESSION['add-errors']['category'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option disabled selected>Choose a type</option>
                            <?php foreach ($products as $idx => $product) : ?>
                                <option value="<?= ++$idx ?>" <?= ($product['id'] == $product['cat_id']) ? 'selected' : '' ?>>
                                    <?= strtoupper($product['type'][0]) . substr($product['type'], 1) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <?php if (isset($_SESSION['add-errors']['type'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['type'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="product_img">Product image</label>
                        <input type="file" class="form-control" name="img" id="product_img" placeholder="Product image">
                        <?php if (isset($_SESSION['add-errors']['img'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['img'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price" value="<?= $product['price'] ?? '' ?>" placeholder="product price">
                        <?php if (isset($_SESSION['add-errors']['price'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['price'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="add-btn" class="btn btn-primary me-2">Update</button>
                    <a href="<?= ROOT_PATH . '/pages/products/show.php/?id=' . $product['id'] ?>" class="btn btn-light">Cancel</a>
                </form>
                <!-- /. Update product -->
            </div>
        </div>

    </div>

</div>
<!--  /. row -->

<?php
$data = '';
unset($_SESSION['add-errors']);
?>

<?php include "./../../shared/footer.php"; ?>