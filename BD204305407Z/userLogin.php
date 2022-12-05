<?php
$user = $_POST['user'];
$password = $_POST['password'];

include('../conexion.php');
$user_query = "SELECT * FROM USUARI WHERE USUARI.nomUsuari = '$user' AND USUARI.contrasenya = '$password'";
$result = consultar("localhost", "root", "", $user_query);

if (($reg = mysqli_fetch_array($result))) {
    session_start();
    $_SESSION["user"] = $reg['nomUsuari'];
    $value = ["user" => $reg['nomUsuari'], "descripcion" => $reg['descripcio']];
} else {
    //Usuari not found
    $value = ["user" => "UserNotFound"];
}
echo json_encode($value);
