<?php

session_start();

if (isset($_SESSION['id'])) {
    header('Location: ./');
    exit;
}


$error = '';

if (!empty($_POST)) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($email && $password) {
        if (file_exists('users.json')) {
            $data = file_get_contents('users.json');
            $json = json_decode($data);

            foreach ($json as $user) {
                if ($user->email === $email) {
                    if (password_verify($password, $user->password)) {
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name;
                        session_regenerate_id();
                        header('Location: ./');
                        exit;
                    } else {
                        $error = 'Invalid email or/and password';
                    }
                }
            }
        }
    }
}


?>

<?php include_once './shared/header.php' ?>

<?php include_once './shared/nav.php' ?>

<main>
    <section id="login">
        <form method="POST" class="container" id="login-form" autocomplete="off" spellcheck="off">
            <?php if ($error) : ?>
                <div class="text-danger">
                    <?= $error ?>
                </div>
            <?php endif ?>
            <div class="mb-3">
                <h1 class="text-center">Login</h1>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" name="email" id="email" autofocus aria-describedby="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}" required>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-dark btn-sm text-uppercase" value="Login">
            </div>
        </form>
    </section>
</main>

<?php include_once './shared/footer.php' ?>