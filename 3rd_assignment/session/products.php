<?php session_start(); ?>

<?php include_once './../shared/nav.php' ?>

<header class="py-3 cart-header">
    <h3 class="text-center">E-Commerce cart</h3>
</header>

<table class="table table-dark table-hover">

    <thead>
        <tr class="text-center">
            <th scope="col">ID</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Availability</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
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

<?php include_once './../shared/footer.php' ?>