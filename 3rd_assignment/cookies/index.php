<?php

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

$color = 'black';

if (!empty($_POST)) {
    $color = filter_input(INPUT_POST, 'color', FILTER_SANITIZE_SPECIAL_CHARS);

    // Expires within a day
    setcookie('color', $color, time() + (60 * 60 * 24));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="./../assets/css/bootstarp.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./../assets/css/reset.css">
    <link rel="stylesheet" href="./../assets/css/register.css">
</head>

<body>
    <header class="bg-<?= $color ?>">
        <nav class="navbar navbar-expand-lg container">
            <div class="container-fluid">
                <a class="navbar-brand" href="./">M&M</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./">
                                <i class="bi bi-house"></i> Home
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./profile.php" title="<?= htmlspecialchars($_SESSION['name']) ?>">
                                <i class="bi bi-person"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">
                                <i class="bi bi-box-arrow-left"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main id="content">

        <div class="container mt-5">

            <form method="POST">

                <div class="mb-3">
                    <select class="form-select" name="color">
                        <option disabled selected>Change navbar background color</option>
                        <option value="primary">Blue</option>
                        <option value="info">Cyan</option>
                        <option value="warning">Orange</option>
                    </select>
                </div>

                <div class="d-flex justify-content-evenly">
                    <input class="btn btn-sm btn-dark" type="submit" value="Change BG">
                </div>
            </form>

        </div>


    </main>


    <?php include_once './shared/footer.php' ?>