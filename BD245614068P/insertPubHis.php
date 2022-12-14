<!-- Recibimos formulario post -->
<?php
    include('../conexion.php'); 
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $idHistoria = $_GET['id'];
    session_start();
    $user = $_SESSION['user'];

    $sql = "INSERT INTO publicacio (titlePub, textPub, nomUsuari, idHistoria) VALUES ('$titulo', '$texto', '$user', '$idHistoria')";
    consultar("localhost", "root", "", $sql);
    header("Location: ../BD204305407Z/showPubli.php?idHistorias=$idHistoria");
?>