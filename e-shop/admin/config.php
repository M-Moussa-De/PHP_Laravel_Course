<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', 'http://localhost:81/exam/admin');
