<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add product</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main>

        <section>
            <form action="handle-add-product.php" method="POST" id="add-product" autocomplete="off" spellcheck="false">

                <h1>Add a product</h1>

                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div>
                    <label for="description">Description (Optional)</label>
                    <input type="text" name="description" id="description">
                </div>

                <div>
                    <label for="price">Price</label>
                    <input type="number" step="0.01" min="0" name="price" id="price" required>
                </div>

                <div>
                    <input type="submit" value="Add product">
                </div>

            </form>
        </section>

    </main>
</body>

</html>