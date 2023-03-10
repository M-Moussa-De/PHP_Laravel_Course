<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// $default_lan = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);

if (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} else {
    $lang = 'en';
}

if ($lang === 'ar') {
    include './arabic.php';
} else {
    include './english.php';
}

?>

<!DOCTYPE html>

<head>

    <!-- Start Links -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Start Home Style -->
    <link rel="stylesheet" href="css/index_style.css">
    <!-- End Home Style -->

    <!-- Start Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@1,400&display=swap" rel="stylesheet">
    <!-- End Google Fonts -->

    <!-- End Links -->

    <title>Haga Helwa</title>

</head>


<body>