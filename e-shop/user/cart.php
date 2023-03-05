<?php session_start() ?>
<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<?php

if (!isset($_SESSION['id']) || isset($_SESSION['admin'])) {

    header('Location: ./');
    exit;
}

?>

<!-- Retrieve data -->
<?php
$total_price = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $product) {
        $id =  $product['id'];
        $sql = <<<SQL
           SELECT *
           FROM products
           WHERE id = $id
       SQL;

        $conn = include 'db.php';
        $result = $conn->query($sql)->fetch_assoc();
        $result['quantity'] = $product['quantity'];

        $products[] = $result;
    }
}

?>

<!-- Remove product -->
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    unset($_SESSION['cart'][$_POST['product_id']]);

    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

?>

<!-- Checkout -->
<?php

if (isset($_POST['confirm-order'])) {
    header('Location: ./confirm_order.php');
    exit;
}

?>

<section id="page-header" class="about-header">
    <h2>#Cart</h2>
    <p>Let's see what you have.</p>
</section>

<?php if (!empty($products)) : ?>
    <section id="cart" class="section-p1">

        <table width="100%">
            <thead>
                <tr class="text-center">
                    <td>Image</td>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Quantity</td>
                    <td>price</td>
                    <td>Subtotal</td>
                    <td>Edit</td>
                    <td>Remove</td>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr class="text-center">
                        <td>
                            <a href='<?= "product.php?id=" . $product['id'] ?>'>
                                <img src='<?= "img/" . $product['img'] ?>' alt="product1">
                            </a>
                        </td>
                        <td><?= $product['name'] ?></td>
                        <td><?= substr($product['description'], 0, 20) ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['price'] * $product['quantity'] ?></td>
                        <?php $total_price += $product['price'] * $product['quantity']; ?>
                        <td><a href='<?= "product.php?id=" . $product['id'] ?>' class="btn btn-success btn-sm">Edit</a></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </section>

    <section id="cart-add" class="section-p1">

        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" placeholder="Enter coupon code">
            <button class="normal">Apply</button>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>
                        <?= $total_price ?>
                    </td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td>
                        <strong>
                            <?= $total_price; ?>
                        </strong>
                    </td>
                </tr>
            </table>
            <form action="confirm_order.php" method="POST">
                <button class="normal" name="confirm-order">proceed to checkout</button>
            </form>
        </div>

    </section>

<?php else : ?>

    <center style="margin: 8rem auto;">Cart empty</center>

<?php endif; ?>

<?php include "footer.php" ?>