<?php
include "conexion.php";
session_start();
$user = $_SESSION["user"];
$missatge = $_GET["missatge"];

$publi_query = "SELECT idPublicacio, titlePub, textPub, USUARI.nomUsuari, dataPub FROM PUBLICACIO 
                        JOIN USUARI ON PUBLICACIO.nomUsuari = '$user' and USUARI.nomUsuari = PUBLICACIO.nomUsuari ORDER BY dataPub DESC";
$result_publi = consultar("localhost", "root", "", $publi_query);
$idR = mysqli_fetch_array($result_publi);
$id = $idR['idPublicacio'];
//mirar porque se insertan siempre en la misma publicación
$string="INSERT INTO resposta (missatgeRes, idPublicacio, nomUsuari) VALUES ('$missatge','$id','$user')";
echo $string;

$insert=consultar("localhost", "root", "", $string);
?>

<meta http-equiv="refresh" content="0; url=home.php">