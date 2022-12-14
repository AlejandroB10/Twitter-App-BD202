<!-- Recibimos formulario post -->
<?php
    include('../conexion.php'); 
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];
    $privacidad = $_POST['privacidad'];
    session_start();
    $user = $_SESSION['user'];

    $sql = "INSERT INTO historia (titleHist, textHist, privacitat, nomUsuari) VALUES ('$titulo', '$texto', '$privacidad', '$user')";
    consultar("localhost", "root", "", $sql);
    header("Location: ../BD204305407Z/profile.php");
?>