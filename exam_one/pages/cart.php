<?php include './../config.php'; ?>
<?php include './../includes/header.php'; ?>
<?php include './../includes/navbar.php'; ?>

<?php $total = 0; ?>

<section id="page-header" class="about-header">
    <h2>#Cart</h2>
    <p>Let's see what you have.</p>
</section>

<section id="cart" class="section-p1 mb-5">
    <header class="py-3 cart-header">
        <h3 class="text-center">Your cart</h3>
    </header>

    <table class="table table-hover">
        <thead class="table-dark">
            <tr class="text-center">
                <td scope="col">Image</td>
                <td scope="col">Name</td>
                <td scope="col">Stock</td>
                <td scope="col">Quantity</td>
                <td scope="col">price</td>
                <td scope="col">Subtotal</td>
                <td scope="col">Remove</td>
                <td scope="col">Edit</td>
            </tr>
        </thead>

        <?php if (isset($_SESSION['cart'])) : ?>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $product) : ?>
                    <tr class="text-center" style="line-height: 3;">
                        <td>
                            <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'products' . DS . $product['src'] ?>" title="<?= $product['title'] ?>" alt="" width="50" height="50" />
                        </td>
                        <td>
                            <?= $product['title'] ?>
                        </td>
                        <td>
                            <?= $product['quantity'] > 0 ? 'In stock' : 'Out of stock' ?>
                        </td>
                        <td>
                            <?= $product['ordered'] ?>
                        </td>
                        <td>
                            <?= '$' . $product['price'] ?>
                        </td>
                        <td>
                            <?= '$' . $product['price'] * $product['ordered'] ?>
                            <?php $total +=  $product['price'] * $product['ordered']  ?>
                        </td>
                        <td>
                            <form action="delete_item.php" method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" class="btn bg-transparent btn-danger border-0">
                                    <i class="text-danger fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="<?= ROOT_PATH . DS . 'pages' . DS . 'edit.php?id=' . $product['id'] ?>">
                                <i class="text-dark fa fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        <?php endif; ?>

    </table>
    <?php if ($total) : ?>
        <div class="px-5 pt-2 d-flex justify-content-end">
            <div>
                <h4>Total: <span style=" color: #088178; font-weight: 700;"><?= '$ ' . number_format($total, 2); ?></span></h4>

                <!-- Checkout -->
                <div class="my-3">
                    <a class="btn btn-success w-100" href="checkout.php">Checkout</a>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="my-4">
            <center class="text-muted">
                <h5>Your cart is currently empty</h5>
                <a href="<?= ROOT_PATH ?>" class="text-success">
                    Add products
                </a>
            </center>
        </div>
    <?php endif; ?>
</section>

<?php include ROOT_PATH .  DS . 'includes' . DS . 'footer.php'; ?>