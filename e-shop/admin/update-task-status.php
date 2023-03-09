<?php

$conn = include './../db.php';

$id = $_POST['id'];
$status = $_POST['status'];
$user_id = $_POST['user_id'];

$sql = "UPDATE todos SET status = '$status' WHERE id = '$id' AND user_id = '$user_id'";
mysqli_query($conn, $sql);

mysqli_close($conn);

var_dump($sql);
