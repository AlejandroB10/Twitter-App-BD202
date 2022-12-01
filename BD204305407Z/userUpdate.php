<?php
include('../conexion.php');

$user = $_POST['user'];
$description = $_POST['description'];
$password = $_POST['password'];

$update_user = "UPDATE USUARI SET USUARI.descripcio = '$description', USUARI.contrasenya = '$password' WHERE USUARI.nomUsuari = '$user'";

consultar("localhost", "root", "", $update_user);


?>