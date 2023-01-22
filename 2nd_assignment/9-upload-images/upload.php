<?php

$note = '';

if (isset($_POST["submit"])) {

    $target_dir = "uploads/";

    $imageName = basename($_FILES["file"]["name"]);

    if (!empty($_POST["imageName"])) {
        $imageName = $_POST["imageName"];
    }

    $target_file = $target_dir . $imageName;

    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $note = "File is not an image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        $note = "Sorry, file already exists.";
        $uploadOk = 0;
    } else if ($_FILES["file"]["size"] > 500000) {
        $note = "Sorry, your file is too large.";
        $uploadOk = 0;
    } else if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        $note = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    } else if ($uploadOk == 0) {
        $note = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $note = "The file " . $imageName . " has been uploaded.";
        } else {
            $note = "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload images</title>
    <style>
        *,
        *::after,
        *::before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        main {
            width: 100%;
            height: 100vh;
            max-height: 100vh;
            position: relative;
            background: #f9f9f9;
        }

        form {
            width: 95%;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 1rem;
            border-radius: 0.2rem;
        }

        @media (min-width: 768px) {
            form {
                width: 30%;
            }

        }

        .text-center {
            text-align: center;
        }

        div {
            margin-bottom: 1rem;
        }

        input {
            border: 1px solid #eee;
            padding: 0.3rem;
            border-radius: 0.2rem;
            outline: none;
            box-shadow: none;
        }

        input[type="submit"] {
            cursor: pointer;
            background: coral;
            color: #fff;
            transition: background 0.3s ease;
            padding: 0.4rem;
        }

        input[type="submit"]:hover {
            background: #d95b2d;
        }

        .note {
            color: coral;
        }
    </style>
</head>

<body>
    <main>

        <section>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <div>
                    <h1 class="text-center">Upload an image</h1>
                </div>
                <div>
                    <?php if (isset($note)) : ?>
                        <span class="note">
                            <?= $note ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="file">Select image to upload</label>
                    <input type="file" name="file" id="file" required>
                </div>

                <div>
                    <label for="imageName">Rename image (optional):</label>
                    <input type="text" name="imageName" id="imageName">
                </div>

                <div>
                    <input type="submit" value="Upload Image" name="submit">
                </div>
            </form>

        </section>

    </main>
</body>

</html>