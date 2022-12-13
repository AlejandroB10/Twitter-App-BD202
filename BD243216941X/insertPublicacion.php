<?php
include "../conexion.php";
session_start();

$user = $_SESSION["user"];

$id_publi_ori = $_GET['idPublicacio'];
$publi_query = "SELECT idPublicacio, titlePub, textPub FROM publicacio where publicacio.idPublicacio = '$id_publi_ori'";
$result_publi = consultar("localhost", "root", "", $publi_query);
$idR = mysqli_fetch_array($result_publi);
$title = $idR["titlePub"];
$text = $idR["textPub"];
$id = $idR['idPublicacio'];

$string="INSERT INTO publicacio (titlePub, textPub, nomUsuari, idPubliOri) VALUES ('$title','$text','$user', '$id')";
echo $string;

$insert=consultar("localhost", "root", "", $string);
header("Location: ../home.php");
?>