<?php

$host = 'localhost';
$user = 'root';
$db = 'E_Shop';
$password = '';

$conn = new mysqli($host, $user, $password, $db);

return $conn;
