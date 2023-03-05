<?php

if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

?>

<section id="header" class="d-flex align-items-center">
    <a href="./">
        <img src="img/logo.png" alt="homeLogo">
    </a>

    <div>
        <ul id="navbar">
            <li class="link">
                <a href="./"><?= $data['shop'] ?></a>
            </li>
            <li class="link">
                <a href="about.php"><?= $data['about'] ?></a>
            </li>
            <li class="link">
                <a href="contact.php"><?= $data['contact'] ?></a>
            </li>
            <li class="link">
                <a href="?lang=en"><?= $data['englisch'] ?></a>
            </li>
            <li class="link">
                <a href="?lang=ar"><?= $data['arabic'] ?></a>
            </li>

            <?php if (isset($_SESSION['id'])) : ?>
                <li class="link">
                    <a href="logout.php"><?= $data['logout'] ?></a>
                </li>
            <?php else : ?>
                <li class="link">
                    <a href="login.php"><?= $data['login'] ?></a>
                </li>

                <li class="link">
                    <a href="signup.php"><?= $data['signup'] ?></a>
                </li>
            <?php endif; ?>

            <li class="link">
                <a id="lg-cart" href="cart.php">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </li>
            <a href="#" id="close"><i class="fas fa-times"></i> </a>
        </ul>

    </div>

    <div id="mobile">
        <a href="cart.php">
            <i class="fas fa-shopping-cart"></i>
        </a>
        <a href="#" id="bar"> <i class="fas fa-outdent"></i> </a>
    </div>
</section>