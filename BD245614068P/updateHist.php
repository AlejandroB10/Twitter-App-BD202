<?php
    include('../conexion.php'); 
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $privacidad = $_POST['privacidad'];
    $id = $_GET['id'];
    session_start();
    $user = $_SESSION['user'];
    if ($titulo != ''){
        $sql = "UPDATE historia SET titleHist = '$titulo' WHERE idHistoria = '$id'";
        consultar("localhost", "root", "", $sql);
    }
    if ($texto != ''){
        $sql = "UPDATE historia SET textHist = '$texto' WHERE idHistoria = '$id'";
        consultar("localhost", "root", "", $sql);
    }
    $sql = "UPDATE historia SET privacitat = '$privacidad' WHERE idHistoria = '$id'";
    consultar("localhost", "root", "", $sql);

    header("Location: ../BD204305407Z/showPubli.php?idHistorias='$id'");
?>