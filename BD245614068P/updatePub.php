<?php
    include('../conexion.php'); 
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $id = $_GET['id'];
    session_start();
    $user = $_SESSION['user'];
    if ($titulo != ''){
        $sql = "UPDATE publicacio SET titlePub = '$titulo' WHERE idPublicacio = '$id'";
        consultar("localhost", "root", "", $sql);
    }
    if ($texto != ''){
        $sql = "UPDATE publicacio SET textPub = '$texto' WHERE idPublicacio = '$id'";
        consultar("localhost", "root", "", $sql);
    }
    header("Location: publicacio.php");
?>