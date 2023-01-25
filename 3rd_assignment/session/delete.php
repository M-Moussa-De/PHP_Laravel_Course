<?php

session_start();

if (!isset($_GET['id'])) {
    header('Location: ./products.php');
    exit;
}

$products = $_SESSION['products'] ?? [];

if (empty($products)) {
    header('Location: ./products.php');
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
$id_array = array_column($products, 'id');
$index = array_search($id, $id_array);
$delete_product = $products[$index];

// Delete product
if (!empty($_POST)) {

    $index = array_search($delete_product, $products);

    $file = $delete_product['img'];

    if (file_exists($file)) {
        unlink($file);
    }

    unset($_SESSION['products'][$index]);
    header('Location: ./products.php');
    exit;
}

?>

<?php include_once './shared/header.php' ?>

<?php include_once './shared/nav.php' ?>

<?php if ($delete_product) : ?>
    <div class="text-center">
        <h5>
            Do you really want to delete
            <strong>
                <?= $delete_product['title'] ?>
            </strong>
        </h5>
        <form method="POST">
            <a href="./products.php" class="btn btn-sm btn-dark">Cancel</a>
            <input type="submit" value="Delete" name="delete" class="btn btn-sm btn-danger">
        </form>
    </div>
<?php else : ?>
    <div class="text-center">
        <h5>
            Product not found
        </h5>
    </div>
<?php endif; ?>

<?php include_once './shared/footer.php' ?>