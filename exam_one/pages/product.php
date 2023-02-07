<?php include './../config.php'; ?>
<?php include ROOT_PATH . DS . 'includes' . DS . 'header.php'; ?>
<?php include ROOT_PATH . DS . 'includes' . DS . 'navbar.php'; ?>

<?php

if (empty($_GET['id'])) {
    header('Location:' . ROOT_PATH);
    exit;
}
?>

<?php

// Show product
$cart = [];
$pro = [];
$products_json = json_decode(file_get_contents('./../database/products.json'), true);
foreach ($products_json['products']['featuredProducts'] as $product) {

    if ($product['id'] == $_GET['id']) {
        $pro = $product;
        break;
    }
}

// Add product to cart
if (isset($_POST['products_sum'])) {

    $products_sum = $_POST['products_sum'] ?? 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $pro["ordered"] = $products_sum;

    $item = $pro;

    array_push($_SESSION['cart'], $item);

    header('Location: ' . ROOT_PATH . DS . 'pages' . DS . '?added=true');
    exit;
}

?>

<main class="my-5 pt-4">

    <div class="container my-5">

        <?php if (!empty($pro)) : ?>

            <!--Grid row-->
            <div class="row gap-0 gap-md-5">
                <!--Grid column-->
                <div class="col-md-4 mb-4">
                    <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'products' . DS . $pro['src'] ?>" class="img-fluid" alt="product image" />
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-4">
                    <!--Content-->
                    <div class="p-4">
                        <div class="mb-3">
                            <a href="">
                                <span class="badge bg-info me-1">New</span>
                            </a>
                            <a href="">
                                <span class="badge bg-danger me-1">Bestseller</span>
                            </a>
                        </div>

                        <p class="lead">
                            <span class="me-1">
                                <del>
                                    $ <?= $pro['price'] + ($pro['price'] * 0.15) ?>
                                </del>
                            </span>
                            <span>
                                <?= $pro['price'] ?>
                            </span>
                        </p>

                        <strong>
                            <p style="font-size: 20px;">Description</p>
                        </strong>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et dolor suscipit libero eos atque quia ipsa sint voluptatibus! Beatae sit assumenda asperiores iure at maxime atque repellendus maiores quia sapiente.</p>

                        <form class="d-flex justify-content-left" method="POST">
                            <!-- Default input -->
                            <div class="form-outline me-1" style="width: 100px;">
                                <input type="number" pattern="[1-9]*" min="1" max="<?= $pro['quantity'] ?>" name="products_sum" value="1" class="form-control" />
                            </div>
                            <button class="btn btn-success ms-1" type="submit" name="addToCart">
                                Add to cart
                                <i class="fas fa-shopping-cart ms-1"></i>
                            </button>
                        </form>
                    </div>
                    <!--Content-->
                </div>
                <!--Grid column-->
            </div>

        <?php else : ?>

            <h3 class="text-center">Product not found</h3>


        <?php endif; ?>
        <!--Grid row-->
    </div>
</main>

<?php include ROOT_PATH .  DS . 'includes' . DS . 'footer.php'; ?>