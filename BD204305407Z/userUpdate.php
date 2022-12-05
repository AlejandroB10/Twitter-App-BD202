<?php
include('../conexion.php');

$user = $_POST['user'];
$description = $_POST['description'];
$password = $_POST['password'];

$update_user = "UPDATE usuari SET usuari.descripcio = '$description', usuari.contrasenya = '$password' WHERE usuari.nomUsuari = '$user'";

consultar("localhost", "root", "", $update_user);


?>