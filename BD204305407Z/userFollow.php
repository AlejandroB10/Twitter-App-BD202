<?php
include('../conexion.php');

$user_seguint = $_POST['user_seguint'];
$user_seguidor = $_POST['user_seguidor'];

$insert_user_follow = "INSERT INTO follow (nomUsuariSeguint, nomUsuariSeguidor) VALUES ('$user_seguint', '$user_seguidor')";

consultar("localhost", "root", "", $insert_user_follow);

?>