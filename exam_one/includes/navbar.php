<?php session_start(); ?>
<?php include './../config.php'; ?>

<header id="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary w-100">
        <div class="container-fluid">
            <a href="<?= ROOT_PATH . DS  ?>" class="navbar-brand">
                <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'logo.png' ?>" alt="homeLogo">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="navbar-toggler-icon fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav w-100 justify-content-end mb-2 mb-lg-0" id="navbar">
                    <li class="nav-item mt-3 mt-md-0">
                        <a href="<?= ROOT_PATH ?>">Shop</a>
                    </li>
                    <li class="nav-item mt-3 mt-md-0">
                        <a href="<?= ROOT_PATH . DS . 'about.php' ?>">About</a>
                    </li>
                    <li class="nav-item mt-3 mt-md-0">
                        <a href="<?= ROOT_PATH . DS . 'contact.php' ?>">Contact</a>
                    </li>

                    <?php if (!isset($_SESSION['username'])) : ?>
                        <li class="nav-item mt-3 mt-md-0">
                            <a href="<?= ROOT_PATH . DS . 'auth' ?>">Login</a>
                        </li>
                        <li class="nav-item mt-3 mt-md-0">
                            <a href="<?= ROOT_PATH . DS . 'auth' . DS . 'signup.php' ?>">Signup</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item mt-3 mt-md-0">
                            <a href="<?= ROOT_PATH . DS . 'profile'; ?>">
                                Welcome <?= htmlspecialchars($_SESSION['username']) ?>
                            </a>
                        </li>
                        <li class="nav-item mt-3 mt-md-0">
                            <a href="<?= ROOT_PATH . DS . 'auth' . DS . 'logout.php' ?>">Logout</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item mt-3 mt-md-0">
                        <a id="lg-cart" href="<?= ROOT_PATH . DS . 'pages' .  DS . 'cart.php' ?>">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>