<?php

include('../conexion.php');

$user = $_POST['user'];
$user_following = $_POST['user_follo'];

$unfollow_query = "DELETE FROM FOLLOW WHERE FOLLOW.nomUsuariSeguidor = '$user' and FOLLOW.nomUsuariSeguint = '$user_following'";

$result_unfollow = consultar("localhost", "root", "", $unfollow_query);

?>