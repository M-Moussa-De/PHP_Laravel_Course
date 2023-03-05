<?php session_start(); ?>
<?php if (!isset($_SESSION['cart'])) $_SESSION['cart'] = []; ?>
<!-- Retrieve data -->
<?php
$conn = include 'db.php';

$sql = <<<SQL
    SELECT *
    FROM products
SQL;

$res = $conn->query($sql);

if ($res->num_rows > 0) {

    $products = [];
    while ($row = $res->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!-- Add to cart -->
<?php
// session_destroy();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? '';

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'quantity' => 1
        ];
    }
    ksort($_SESSION['cart'], SORT_NUMERIC);
}
?>

<?php include "header.php"; ?>
<?php include "navbar.php"; ?>

<!-- Hero -->
<section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all products</h1>
    <p>Save more woth coupons & up to 70% off!</p>
    <button>Shop Now!</button>
</section>
<!-- End Hero -->

<!-- start Feature-->
<section id="feature" class="section-p1">
    <div class="fe-1">
        <img src="img/features/f1.png" alt="">
        <h6>Free Shipping</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f2.png" alt="">
        <h6>Online Order</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f3.png" alt="">
        <h6>Save Money</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f4.png" alt="">
        <h6>Promitions</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f5.png" alt="">
        <h6>Happy Sell</h6>
    </div>
    <div class="fe-1">
        <img src="img/features/f6.png" alt="">
        <h6>F7/24 Support</h6>
    </div>
</section>
<!-- End Feature-->

<!-- Start Featured Products -->
<section id="product1" class="section-p1">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modren Desgin</p>
    <div class="pro-container">
        <?php foreach ($products as $product) : ?>
            <?php if ($product['type'] == 'product') : ?>
                <div class="pro">
                    <img src='<?= "img/" . $product['img'] ?>' alt='<?= "p" . $product['i'] ?>' />
                    <div class="des">
                        <span><?= $product['brand'] ?></span>
                        <h5><?= $product['name'] ?></h5>
                        <div class="star">
                            <?php for ($i = 0; $i < $product['stars']; $i++) : ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <h4><?= $product['price'] ?></h4>
                            <div><a href="product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-success">Details</a></div>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button role="button" type="submit" name="add_to_cart" class="cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
<!-- End Featured Products -->

<!-- Start bannar -->
<section id="bannar" class="section-m1">
    <h4>Repair Service</h4>
    <h2>Up to <span>70% Off</span> - All t-Shirts & Accessories</h2>
    <button class="normal">Explore More</button>
</section>
<!-- End bannar -->

<!-- New Arrival -->
<section id="product1" class="section-p1">
    <h2>New Arrival</h2>
    <p>Summer Collection New Modren Desgin</p>
    <div class="pro-container">
        <?php foreach ($products as $product) : ?>
            <?php if ($product['type'] == 'new_arrival') : ?>
                <div class="pro">
                    <img src='<?= "img/" . $product['img'] ?>' alt='<?= "p" . $product['i'] ?>' />
                    <div class="des">
                        <span><?= $product['brand'] ?></span>
                        <h5><?= $product['name'] ?></h5>
                        <div class="star">
                            <?php for ($i = 0; $i < $product['stars']; $i++) : ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <h4>78</h4>
                        <div class="d-flex align-items-center justify-content-between">
                            <h4><?= $product['price'] ?></h4>
                            <div><a href="product.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-success">Details</a></div>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button role="button" type="submit" name="add_to_cart" class="cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>
<!-- End New Arrival -->

<section id="sm-bannar" class="section-p1">
    <div class="bannar-box">
        <h4>Crazy Deals</h4>
        <h2>buy 1 get 1 Free</h2>
        <span>The best classic dress is on sale from cara</span>
        <button class="white">Learn More</button>
    </div>
    <div class="bannar-box bannar-box2">
        <h4>Spring/Summer</h4>
        <h2>buy 1 get 1 Free</h2>
        <span>The best classic dress is on sale from cara</span>
        <button class="white">Learn More</button>
    </div>

</section>

<section id="bannar3" class="section-p1">
    <div class="bannar-box">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection - 50% off</h3>
    </div>
    <div class="bannar-box bannar-box2">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection - 50% off</h3>
    </div>
    <div class="bannar-box bannar-box3">
        <h2>SEASONAL SALE</h2>
        <h3>Winter Collection - 50% off</h3>
    </div>
</section>

<section id="newsletter" class="section-p1 section-m1">
    <div class="newstext">
        <h4>Sign Up For Newletters</h4>
        <p>Get E-mail Updates about our latest shop and <span class="text-warning">Special Offers.</span></p>
    </div>
    <div class="form">
        <input type="text" placeholder="Enter Your E-mail...">
        <button class="normal">Sign Up</button>
    </div>
</section>

<?php include 'footer.php' ?>