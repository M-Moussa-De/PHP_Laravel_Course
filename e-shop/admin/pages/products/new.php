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

if (isset($_SESSION['data'])) {

    $data = $_SESSION['data'];

    unset($_SESSION['data']);
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

?>

<?php include "./../../shared/header.php"; ?>

<!-- row -->
<div class="row" style="margin-top: 5rem;">

    <div class="col-md-6 mx-auto grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Add product</h4>
                <form action="<?= ROOT_PATH . '/pages/products/process-forms/new-process.php' ?>" id="addProduct" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Product name</label>
                        <input type="text" class="form-control" name="name" id="product_name" value="<?= $data['name'] ?? '' ?>" placeholder="Product name">
                        <?php if (isset($_SESSION['add-errors']['name'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['name'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="product_brand">Product brand</label>
                        <input type="text" class="form-control" name="brand" id="product_brand" value="<?= $data['brand'] ?? '' ?>" placeholder="Product brand">
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
                                    <option value="<?= $c['id'] ?>"><?= strtoupper($c['name'][0]) . substr($c['name'], 1) ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                        <?php if (isset($_SESSION['add-errors']['category'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['category'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-select" id="type" name="type">
                            <option disabled selected>Choose a type</option>
                            <?php if (isset($products)) : ?>
                                <?php foreach ($products as $idx => $product) : ?>
                                    <option value="<?= ++$idx ?>"><?= strtoupper($product['type'][0]) . substr($product['type'], 1) ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
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
                        <input type="text" class="form-control" name="price" id="price" value="<?= $data['price'] ?? '' ?>" placeholder="product price">
                        <?php if (isset($_SESSION['add-errors']['price'])) : ?>
                            <small class="text-danger">
                                <?= $_SESSION['add-errors']['price'] ?>
                            </small>
                        <?php endif; ?>
                    </div>
                    <button type="submit" name="add-btn" class="btn btn-primary me-2">Add</button>
                    <a href="<?= ROOT_PATH . '/pages/products' ?>" class="btn btn-dark">Cancel</a>
                </form>
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