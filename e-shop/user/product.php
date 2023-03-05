<?php session_start(); ?>
<?php
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}
?>

<?php if (!isset($_SESSION['cart'])) $_SESSION['cart'] = []; ?>

<!-- Retrieve data -->
<?php
$conn = include 'db.php';
$product_id = $_GET['id'];
$sql = <<<SQL
    SELECT *
    FROM products
    WHERE id = '$product_id'
SQL;

$res = $conn->query($sql);
$product = $res->fetch_assoc();

$found = $product ?  true : false;
?>

<!-- Add to cart -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $_POST['quantity'];
    } else {
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'quantity' => 1
        ];
    }
    ksort($_SESSION['cart'], SORT_NUMERIC);

    header('Location: ./cart.php');
    exit;
}

?>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<?php if ($found) : ?>

    <section class="py-5">
        <div class="container py-5">
            <div class="row">

                <div class="col-md-6">
                    <img src='<?= "img/" . $product['img'] ?>' class="card-img-top" alt="<?= $product['name'] ?>" />
                </div>

                <div class="col-md-6 px-md-5">
                    <div class="text-center">
                        <h5 class="card-title"><?= $product['name']  ?></h5>
                        <p class="text-muted mb-4"><?= $product['brand'] ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="text-muted mb-4">$<?= $product['price'] ?></p>
                        <div class="star text-warning">
                            <?php for ($i = 0; $i < $product['stars']; $i++) : ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div>
                        <p class="text-muted mb-4"><?= $product['description'] ?></p>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="number" name="quantity" value="1" min="1" class="w-25 text-center">
                            <button role="button" type="submit" name="add_to_cart" class="btn btn-success">
                                Add to cart
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

<?php else : ?>

    <center style="margin: 12rem auto;">
        <b>Product not found</b>
    </center>

<?php endif; ?>

<?php include 'footer.php' ?>