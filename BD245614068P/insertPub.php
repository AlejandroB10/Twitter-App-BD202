<!-- Recibimos formulario post -->
<?php
    include('../conexion.php'); 
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    session_start();
    $user = $_SESSION['user'];

    $sql = "INSERT INTO publicacio (titlePub, textPub, nomUsuari) VALUES ('$titulo', '$texto', '$user')";
    consultar("localhost", "root", "", $sql);
    header("Location: publicacio.php");
?>