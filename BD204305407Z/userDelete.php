<?php

include('../conexion.php');

$user = $_POST['user'];

$delete_user_query = "CALL deleteUser('$user')";

$result_deleteUser = consultar("localhost", "root", "", $delete_user_query);

?>