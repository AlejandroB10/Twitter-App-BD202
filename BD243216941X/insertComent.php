<?php
include "../conexion.php";
session_start();
$user = $_SESSION["user"];
$missatge = $_POST["missatge"];
$id = $_GET['id'];
$origin = $_POST["origin"];
//mirar porque se insertan siempre en la misma publicación
$string="INSERT INTO resposta (missatgeRes, idPublicacio, nomUsuari) VALUES ('$missatge','$id','$user')";
echo $string;

$insert=consultar("localhost", "root", "", $string);
if ($origin == 1) {
    header("Location: ../home.php");
}elseif ($origin == 2){
    header("Location: ../BD204305407Z/profile.php");
}else{
    $user_profile = $_POST["user_profile"];
    header("Location: ../BD204305407Z/profileUser.php?id=".$user_profile);
}
?>
