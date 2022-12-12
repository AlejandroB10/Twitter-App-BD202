<?php
include "../conexion.php";
session_start();
$user = $_SESSION["user"];
$missatge = $_POST["missatge"];
$id = $_GET['id'];

//mirar porque se insertan siempre en la misma publicación
$string="INSERT INTO resposta (missatgeRes, idPublicacio, nomUsuari) VALUES ('$missatge','$id','$user')";
echo $string;

$insert=consultar("localhost", "root", "", $string);
?>

<meta http-equiv="refresh" content="5; url=../home.php">