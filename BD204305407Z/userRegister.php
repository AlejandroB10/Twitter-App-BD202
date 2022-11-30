<?php
include('../conexion.php');

$user = $_POST['user'];
$password = $_POST['password'];

$insert_user = "INSERT INTO USUARI (nomUsuari, contrasenya) VALUES ('$user', '$password')";

consultar("localhost", "root", "", $insert_user);

session_start();
$_SESSION["user"] = $reg['nomUsuari'];
?>