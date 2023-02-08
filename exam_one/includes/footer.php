<?php include_once './../config.php'; ?>

<footer class="section-p1">
    <div class="col">
        <a href="index.html">
            <link rel="stylesheet" href="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'logo.png'; ?>">
        </a>
        <h4>Contact</h4>
        <p><strong>Address: </strong>321 Nile Road, street 320, Cairo</p>
        <p><strong>Phone: </strong>0105487541</p>
        <p><strong>Hourse: </strong>10AM - 10Pm, Sat- thus</p>
        <div class="follow">
            <h4>Follow US :</h4>
            <div class="icon">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="col">
        <h4>About Us</h4>
        <a href="pages/about.php">About Us</a>
        <a href="#">Delivery information</a>
        <a href="#">Privacy policy</a>
        <a href="#">Terms & Condtions</a>
        <a href="#">Contact Us</a>
    </div>
    <div class="col">
        <h4>My Account</h4>
        <link rel="stylesheet" href="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'logo.png'; ?>">

        <a href="<?= ROOT_PATH . DS . 'auth'; ?>">Login</a>
        <a href="<?= ROOT_PATH . DS . 'auth'; ?>">Login</a>
        <a href="<?= ROOT_PATH . DS . 'pages' . DS . 'cart.php'; ?>">View Cart</a>
        <a href="#">My Whishlist</a>
        <a href="#">Track My order</a>
        <a href="#">Help</a>
    </div>
    <div class="col install">
        <h4>Install App</h4>
        <p>From App Store Or Google Play</p>
        <div class="oo">
            <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'pay' . DS . 'app.jpg'; ?>" alt=" ">
            <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'pay' . DS . 'play.jpg'; ?>" alt=" ">
        </div>
        <p>Secure payment For your happy Service</p>
        <img src="<?= ROOT_PATH . DS . 'assets' . DS . 'img' . DS . 'pay' . DS . 'pay.png'; ?>" alt=" ">
    </div>

    <div class="copyright">
        <p> all The right reserved for M&M, 2022</p>
    </div>
</footer>

<script src="<?= ROOT_PATH . DS . 'assets' . DS . 'js' . DS . 'all.min.js'; ?>"></script>
<script src="<?= ROOT_PATH . DS . 'assets' . DS . 'js' . DS . 'bootstrap.bundle.min.js' ?>"></script>
<script src="<?= ROOT_PATH . DS . 'assets' . DS . 'js' . DS . 'main.js'; ?>"></script>

</body>

</html>