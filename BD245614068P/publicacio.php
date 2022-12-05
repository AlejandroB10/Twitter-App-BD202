<?php

include('../conexion.php');

$publicacions_query = "SELECT * FROM publicacio WHERE nomUsuari != '[usuario actual]' AND idHistoria = NULL ORDER BY dataPub;";


$result_chats = consultar("localhost", "root", "", $publicacions_query);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    while ($row = mysqli_fetch_array($result_chats)) { ?>

    <?php } ?>
</body>

</html>