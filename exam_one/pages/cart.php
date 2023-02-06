<?php include './../config.php'; ?>
<?php include './../includes/header.php'; ?>
<?php include './../includes/navbar.php'; ?>

<section id="page-header" class="about-header">
    <h2>#Cart</h2>
    <p>Let's see what you have.</p>
</section>

<section id="cart" class="section-p1 mb-5">
    <header class="py-3 cart-header">
        <h3 class="text-center">E-Commerce cart</h3>
    </header>

    <table class="table table-dark table-hover">
        <thead>
            <tr class="text-center">
                <td scope="col">Image</td>
                <td scope="col">Name</td>
                <td scope="col">Desc</td>
                <td scope="col">Quantity</td>
                <td scope="col">price</td>
                <td scope="col">Subtotal</td>
                <td scope="col">Remove</td>
                <td scope="col">Edit</td>
            </tr>
        </thead>

        <?php if (isset($_SESSION['products'])) : ?>
            <tbody>
                <?php foreach ($_SESSION['products'] as $product) : ?>
                    <tr class="text-center" style="line-height: 3;">
                        <td>
                            <?= $product['id'] ?>
                        </td>
                        <td>
                            <img src="<?= $product['img'] ?>" title="<?= $product['title'] ?>" alt="<?= $product['title'] ?>" width="50" height="50" />
                        </td>
                        <td>
                            <?= $product['title'] ?>
                        </td>
                        <td>
                            <?= $product['quantity'] > 0 ? 'In stock' : 'Out of stock' ?>
                        </td>
                        <td>
                            <?= $product['quantity'] ?>
                        </td>
                        <td>
                            <?= '$' . $product['price'] ?>
                        </td>
                        <td>
                            <a href='<?= "delete.php?id=" . $product['id'] ?>'>
                                <i class="bi bi-trash3 text-danger"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        <?php endif; ?>

    </table>
</section>

<?php include ROOT_PATH .  DS . 'includes' . DS . 'footer.php'; ?>