<header id="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-0 px-md-4">
        <div class="container-fluid">
            <a href="http://localhost:8080/projects/php_laravel_course/exam_one" class="navbar-brand">
                <img src="http://localhost:8080/projects/php_laravel_course/exam_one/assets/img/logo.png" alt="homeLogo">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="navbar-toggler-icon fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="navbar-nav w-100 justify-content-end mb-2 mb-lg-0" id="navbar">
                    <li class="nav-item mt-3 mt-md-0">
                        <a href="http://localhost:8080/projects/php_laravel_course/exam_one/">Shop</a>
                    </li>
                    <li class="nav-item mt-3 mt-md-0">
                        <a href="http://localhost:8080/projects/php_laravel_course/exam_one/pages/about.php">About</a>
                    </li>
                    <li class="nav-item mt-3 mt-md-0">
                        <a href="http://localhost:8080/projects/php_laravel_course/exam_one/pages/contact.php">Contact</a>
                    </li>

                    <?php if (!isset($_SESSION['username'])) : ?>
                        <li class="nav-item mt-3 mt-md-0">
                            <a href="http://localhost:8080/projects/php_laravel_course/exam_one/auth">Login</a>
                        </li>
                        <li class="nav-item mt-3 mt-md-0">
                            <a href="http://localhost:8080/projects/php_laravel_course/exam_one/auth/signup.php' ?>">Signup</a>
                        </li>
                    <?php else : ?>

                        <div class="dropdown">
                            <button class="dropdown-toggle mt-3 mt-md-0" style="border: none; outline: none; background: transparent !important" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item">
                                    <a href="http://localhost:8080/projects/php_laravel_course/exam_one/pages/profile">Profile</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="http://localhost:8080/projects/php_laravel_course/exam_one/auth/logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>

                    <?php endif; ?>

                    <li class="nav-item mt-3 mt-md-0">
                        <a id="lg-cart" href="http://localhost:8080/projects/php_laravel_course/exam_one/pages/cart.php">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>