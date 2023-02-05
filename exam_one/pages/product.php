<?php session_start(); ?>
<?php include './../config.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'header.php'; ?>
<?php include ROOT_PATH .  DS . 'includes' . DS . 'navbar.php'; ?>

<?php

// if (!isset($_GET['id'])) {
//     header('Location:' . ROOT_PATH);
//     exit;
// }


$pro = [];
$products_json = json_decode(file_get_contents('./../database/products.json'), true);
foreach ($products_json['products']['featuredProducts'] as $product) {

    if ($product['id'] == $_GET['id']) {
        $pro = $product;
        break;
    }
}


?>

<section id="product1" class="section-p1 mt-5">
    <div class="row">

        <div class="col-12 col-md-6">
            <div>
                <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'products' . DS . $pro['src'] ?>" alt="p1" style="height: 250px" />
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="des">
                <h5>
                    <?= $product['title'] ?>
                </h5>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui modi sapiente laudantium nihil illo suscipit sed hic molestias quisquam corrupti aperiam nam et quae, officiis voluptate, quos saepe perferendis impedit animi eveniet maxime sit eum sint inventore. Corrupti similique ea autem. In maxime dignissimos nulla accusamus, expedita tenetur quis ducimus!</p>
                </div>
                <div class="star">
                    <?php for ($i = 0; $i < $product['stars']; $i++) : ?>
                        <i class="fas fa-star" style="color: rgb(243, 181, 25)"></i>
                    <?php endfor; ?>
                </div>
                <h4 style="color: #088178">
                    <?= $product['brand'] ?>
                </h4>
                <h4 style="color: #088178">
                    $ <?= $product['price'] ?>
                </h4>
                <div>
                    <span>-</span>
                    <input min="1" value="1" readonly class="text-center" style="width: 1.5rem;" />
                    <span>+</span>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include ROOT_PATH .  DS . 'includes' . DS . 'footer.php'; ?>