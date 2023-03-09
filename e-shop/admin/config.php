<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', 'http://e-shop.localhost/admin');
