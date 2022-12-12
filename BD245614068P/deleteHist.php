<!-- Eliminamos publiacion -->
<?php
    include('../conexion.php'); 
    $id = $_GET['id'];

    $sql = "DELETE FROM historia WHERE idHistoria = '$id'";
    consultar("localhost", "root", "", $sql);
    header("Location: publicacio.php");
?>