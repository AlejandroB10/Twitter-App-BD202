<?php
include "../conexion.php";
session_start();

$user = $_SESSION["user"];

$publi_query = "SELECT idPublicacio, titlePub, textPub FROM PUBLICACIO 
                        JOIN USUARI ON PUBLICACIO.nomUsuari = '$user' and USUARI.nomUsuari = PUBLICACIO.nomUsuari ORDER BY dataPub DESC";
$result_publi = consultar("localhost", "root", "", $publi_query);
$idR = mysqli_fetch_array($result_publi);
$title = $idR["titlePub"];
$text = $idR["textPub"];
$id = $idR['idPublicacio'];


$string="INSERT INTO publicacio (titlePub, textPub, nomUsuari, idPubliOri) VALUES ('$title','$text','$user', '$id')";
echo $string;

$insert=consultar("localhost", "root", "", $string);
?>

<meta http-equiv="refresh" content="5; url=../home.php">