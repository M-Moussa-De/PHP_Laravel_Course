<?php include './config.php'; ?>
<?php include ROOT_PATH . DS . 'includes' . DS . 'header.php'; ?>
<?php include ROOT_PATH . DS . 'includes' . DS . 'navbar.php'; ?>

<?php

// Database
$features = [];
$features_json = json_decode(file_get_contents('./database/products.json'), true);
foreach ($features_json['products']['features'] as $feature) {
    $features[] = $feature;
}

$featuredProducts = [];
$featuredProducts_json = json_decode(file_get_contents('./database/products.json'), true);
foreach ($featuredProducts_json['products']['featuredProducts'] as $feature) {
    $featuredProducts[] = $feature;
}

$newArrivals = [];
$newArrival_json = json_decode(file_get_contents('./database/products.json'), true);
foreach ($newArrival_json['products']['newArrival'] as $feature) {
    $newArrivals[] = $feature;
}
?>

<!-- Hero -->
<section id="hero">
    <h4>Trade-in-offer</h4>
    <h2>Super value deals</h2>
    <h1>On all products</h1>
    <p>Save more woth coupons & up to 70% off!</p>
    <a href="#feature">Shop Now!</a>
</section>
<!-- End Hero -->

<!-- start Feature-->
<section id="feature" class="section-p1">
    <?php foreach ($features as $feature) : ?>
        <div class="fe-1">
            <img src="<?= ROOT_PATH .  DS  . 'assets' . DS . 'img' . DS . 'features' . DS . $feature['src'] ?>" alt="">
            <h6><?= $feature['title'] ?></h6>
        </div>
    <?php endforeach; ?>
</section>
<!-- End Feature-->

<!-- Start New Arrival or productCard Features -->
<section id="product1" class="section-p1 position-relative">
    <h2>Featured Products</h2>
    <p>Summer Collection New Modren Desgin</p>
    <div class="pro-container">

        <?php foreach ($featuredProducts as $featuredProduct) : ?>
            <div class="pro">
                <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'products' . DS . $featuredProduct['src'] ?>" alt="p1">
                <div class="des">
                    <span>
                        <?= $featuredProduct['brand'] ?>
                    </span>
                    <h5>
                        <?= $featuredProduct['title'] ?>
                    </h5>
                    <div class="star">
                        <?php for ($i = 0; $i < $featuredProduct['stars']; $i++) : ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <h4 class="position-absolute top-0 mt-3 mx-2">
                        $ <?= $featuredProduct['price'] ?>
                    </h4>
                    <div class="d-flex justify-content-center mt-3">
                        <a class="btn btn-outline-success btn-sm px-5" href="<?= ROOT_PATH . DS . 'pages' . DS . 'product.php?id=' . $featuredProduct['id'] ?>" class="cart">
                            View
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>
<!-- End New Arrival -->

<!-- Start bannar -->
<section id="bannar" class="section-m1">
    <h4>Repair Service</h4>
    <h2>Up to <span>70% Off</span> - All t-Shirts & Accessories</h2>
    <button class="normal">Explore More</button>
</section>
<!-- End bannar -->

<section id="product1" class="section-p1">
    <h2>New Arrival</h2>
    <p>Summer Collection New Modren Desgin</p>
    <div class="pro-container">

        <?php foreach ($newArrivals as $newArrival) : ?>
            <div class="pro">
                <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'products' . DS . $newArrival['src'] ?>" alt="p1">
                <div class="des">
                    <span>
                        <?= $featuredProduct['brand'] ?>
                    </span>
                    <h5>
                        <?= $featuredProduct['title'] ?>
                    </h5>
                    <div class="star">
                        <?php for ($i = 0; $i < $newArrival['stars']; $i++) : ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <h4 class="my-2">
                        $ <?= $newArrival['price'] ?>
                    </h4>
                    <div>
                        <a href="<?= ROOT_PATH . DS . 'pages' . DS . 'cart.php?id=' . $newArrival['id'] ?>" class="cart">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        <a class="btn btn-outline-success btn-sm px-5" href="<?= ROOT_PATH . DS . 'pages' . DS . 'product.php?id=' . $newArrival['id'] ?>" class="cart">
                            View
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>
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

<?php include ROOT_PATH .  DS . 'includes' . DS . 'footer.php'; ?>