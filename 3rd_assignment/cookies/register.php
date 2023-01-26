<?php

$registered = false;

if (!empty($_POST)) {

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    $is_pass_valid = filter_var($password, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/")));

    if ($name && $email && $password) {
        try {

            if (file_exists('users.json')) {
                $json = file_get_contents('users.json');
                $data = json_decode($json, true);
            }

            $newUser = [
                'id' => time(),
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            $data[] = $newUser;
            $jsonData = json_encode($data);
            file_put_contents('users.json', $jsonData);
            $registered = true;
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
}


?>

<?php include_once './shared/header.php' ?>

<?php include_once './shared/nav.php' ?>

<main>
    <section id="register">
        <form method="POST" class="container" id="register-form" autocomplete="off" spellcheck="off">
            <?php if ($registered) : ?>
                <div class="alert alert-success py-1">
                    Registered successfully
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <h1 class="text-center">Register</h1>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" autofocus aria-describedby="name" pattern="[A-Za-z]+ [A-Za-z]+" required>
                <div class="text-danger" id="error-message"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}" required>
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-dark btn-sm text-uppercase" value="Register">
            </div>
        </form>
    </section>
</main>

<?php include_once './shared/footer.php' ?>