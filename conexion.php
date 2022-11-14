<?php
function consultar($server, $user, $password, $query)
{
    $conexion = mysqli_connect($server, $user, $password) or die;
    $db = mysqli_select_db($conexion, "practica2") or die;
    $result = mysqli_query($conexion, $query) or die;
    mysqli_close($conexion);
    return $result;
}