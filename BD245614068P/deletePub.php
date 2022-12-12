<!-- Eliminamos publiacion -->
<?php
    include('../conexion.php'); 
    $id = $_GET['id'];

    $sql = "DELETE FROM publicacio WHERE idPublicacio = '$id'";
    consultar("localhost", "root", "", $sql);
    header("Location: publicacio.php");
?>