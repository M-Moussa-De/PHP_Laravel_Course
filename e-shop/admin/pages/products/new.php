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

// Retrive categories
$conn = include './../../../user/db.php';

$sql = <<<SQL
  SELECT id, name
  FROM categories
SQL;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cat = $result->fetch_all(MYSQLI_ASSOC);
}

?>

<?php include ROOT_PATH .  "/shared/header.php"; ?>

<!-- row -->
<div class="row" style="margin-top: 5rem;">

    <div class="col-md-6 mx-auto grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Add product</h4>
                <!-- action="<?= ROOT_PATH . '/pages/products/forms/add-process.php' ?>" -->
                <form id="addProduct" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Product name</label>
                        <input type="text" class="form-control" name="name" id="product_name" placeholder="Product name">
                    </div>
                    <div class="form-group">
                        <label for="product_brand">Product brand</label>
                        <input type="text" class="form-control" name="brand" id="product_brand" placeholder="Product brand">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option disabled selected>Choose a category</option>
                            <?php if (isset($cat)) : ?>
                                <?php foreach ($cat as $c) : ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_img">Product image</label>
                        <input type="file" class="form-control" name="img" id="product_img" placeholder="Product image">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="product price">
                    </div>
                    <button type="submit" name="add-btn" class="btn btn-primary me-2">Add</button>
                    <a href="<?= ROOT_PATH . '/pages/products' ?>" class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>

    </div>

</div>
<!--  /. row -->

<?php include "../../shared/footer.php"; ?>