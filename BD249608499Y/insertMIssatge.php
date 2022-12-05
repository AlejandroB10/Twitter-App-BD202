<?php
include('../conexion.php');

$nomUsuari = $_POST['nomUsuari'];
$nomReceptor = $_POST['nomReceptor'];
$missatge = $_POST['missatge'];


$insert_missatge = "INSERT INTO missatge (nomUsuariEmi,nomUsuariRec,missatge) VALUES ('$nomUsuari', '$nomReceptor','$missatge')";

consultar("localhost", "root", "", $insert_missatge);

?>