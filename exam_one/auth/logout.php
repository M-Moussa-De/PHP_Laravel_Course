<?php

session_start();

include './../config.php';

session_destroy();

header('Location: ' . ROOT_PATH . DS . 'auth?loggedout=true');
exit;
