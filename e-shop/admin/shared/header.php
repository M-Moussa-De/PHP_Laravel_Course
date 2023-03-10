<?php

$included_files = get_included_files();
$included = false;

foreach ($included_files as $file) {
    $file_name = basename($file);
    if ($file_name == 'config.php') {
        $included = true;
        break;
    }
}

if (!$included) {
    include './../config.php';
}

?>

<!-- Logout -->
<?php

if (isset($_POST['logout'])) {

    session_destroy();

    header('Location: ./../../user/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>M&M</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= ROOT_PATH . '/assets/vendors/mdi/css/materialdesignicons.min.css' ?>">
    <link rel="stylesheet" href="<?= ROOT_PATH . '/assets/vendors/css/vendor.bundle.base.css' ?>">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= ROOT_PATH . '/assets/vendors/jvectormap/jquery-jvectormap.css' ?>">
    <link rel="stylesheet" href="<?= ROOT_PATH . '/assets/vendors/flag-icon-css/css/flag-icon.min.css' ?>">
    <link rel="stylesheet" href="<?= ROOT_PATH . '/assets/vendors/owl-carousel-2/owl.carousel.min.css' ?>">
    <link rel="stylesheet" href="<?= ROOT_PATH . '/assets/vendors/owl-carousel-2/owl.theme.default.min.css' ?>">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?= ROOT_PATH . '/assets/css/style.css' ?>">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?= ROOT_PATH . '/assets/images/favicon.png'  ?>" />
</head>

<body>

    <!-- container-scroller -->
    <div class="container-scroller">

        <!-- _sidebar.php -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="./"><img src="<?= ROOT_PATH . '/assets/images/logo.png' ?>" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="./"><img src="<?= ROOT_PATH . '/assets/images/logo.png' ?>" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="<?= ROOT_PATH . '/assets/images/faces/face7.jpg' ?>" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal"><?= $_SESSION['name'] ?></h5>
                                <span>Gold Member</span>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-settings text-primary"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-onepassword  text-info"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= ROOT_PATH ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                        <span class="menu-icon">
                            <i class="mdi mdi-account-group"></i>
                        </span>
                        <span class="menu-title">Users</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= ROOT_PATH . '/pages/users/new.php' ?>">New</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= ROOT_PATH . '/pages/users' ?>">All users</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
                        <span class="menu-icon">
                            <i class="mdi mdi-package-variant-closed text-primary"></i>
                        </span>
                        <span class="menu-title">Products</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="products">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= ROOT_PATH . '/pages/products' ?>">All products</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= ROOT_PATH . '/pages/products/new.php' ?>">New</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /. _sidebar.php -->

        <!-- page-body-wrapper -->
        <div class="container-fluid page-body-wrapper">

            <!-- _navbar.php -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?= ROOT_PATH . '/assets/images/logo-mini.svg' ?>" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                        <li class="nav-item w-100">
                            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                <input type="text" class="form-control" placeholder="Search products">
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-settings d-none d-lg-block">
                            <a class="nav-link" href="<?= ROOT_PATH . '/../user' ?>">
                                Website
                            </a>
                        </li>
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link btn btn-success create-new-button" id="createbuttonDropdown" data-bs-toggle="dropdown" aria-expanded="false" href="#">+ Add New Product</a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="createbuttonDropdown">
                                <h6 class="p-3 mb-0">Projects</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="<?= ROOT_PATH . '/pages/products/new.php' ?>">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-plus-box-outline text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">New product</p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item" href="<?= ROOT_PATH . '/pages/products' ?>">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-plus-box-outline text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">See all products</p>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="<?= ROOT_PATH . '/assets/images/faces/face7.jpg' ?>" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name"><?= $_SESSION['name']  ?></p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Profile</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="<?= ROOT_PATH . '/profile' ?>">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Settings</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <form method="POST">
                                            <p class="preview-subject mb-1"></p>
                                            <input type="submit" name="logout" class="bg-transparent text-white" value="Log out" />
                                        </form>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- /. _navbar.php -->

            <!-- main-panel -->
            <div class="main-panel py-0">

                <!-- content-wrapper -->
                <div class="content-wrapper">