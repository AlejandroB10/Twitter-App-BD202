<?php


$nomUsuari = 'marc';
$nomReceptor = 'goku';

include('../conexion.php');

$missatges_query = 

"SELECT missatge,dataMissatge,nomUsuariEmi as emisor
 FROM `missatge` 
 WHERE nomUsuariEmi = '".$nomUsuari."' AND nomUsuariRec ='".$nomReceptor."' 
    OR nomUsuariEmi = '".$nomReceptor."' AND nomUsuariRec ='".$nomUsuari."'
ORDER BY dataMissatge;
";

$result_missatges = consultar("localhost", "root", "", $missatges_query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../lib/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <?php include('../header.php'); ?>
    </header>
    <main>
      

        <p> Usuari:  <?php echo $nomUsuari; ?></p><br>
        <p> Receptor:  <?php echo $nomReceptor; ?></p><br>



        <?php 

            while($reg = mysqli_fetch_array($result_missatges)){

                echo "$reg[emisor] ";
                echo "<br>";
                echo "$reg[dataMissatge] ";
                echo "<br>";
                echo "$reg[missatge]";
                echo "<br>";
                echo "<br>";
            }

        ?>
         
    </main>
    <footer>
        <?php include('../footer.php') ?>
    </footer>
</body>

</html>

