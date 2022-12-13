<?php
include('../conexion.php');

$user = $_POST['user'];
$password = $_POST['password'];

$insert_user = "SELECT addUser('$user', '$password')";

$result = consultar("localhost", "root", "", $insert_user);

echo json_encode(mysqli_fetch_array($result));
?>