<?php include_once './shared/header.php' ?>

<?php include_once './shared/nav.php' ?>

<?php include_once './forms_handler/add_product_handler.php' ?>

<section id="form">
    <form method="POST" enctype="multipart/form-data" id="add-product" autocomplete="off" spellcheck="off">
        <div class="mb-3">
            <h1 class="text-center">Add a product</h1>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" autofocus aria-describedby="productTitle" />
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" min="0" class="form-control" id="quantity" name="quantity" aria-describedby="productQuantity" />
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Image</label>
            <input type="file" class="form-control" id="img" name="img" aria-describedby="productImage" />
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" min="0" step="0.01" class="form-control" id="price" name="price" aria-describedby="productPrice" />
        </div>
        <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-sm px-3" value="Add" />
        </div>
    </form>
</section>

<?php include_once './shared/footer.php' ?>