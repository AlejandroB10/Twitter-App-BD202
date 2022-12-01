<?php


$nomUsuari = 'marc';

include('../conexion.php');

$usuarios_query = "SELECT nomUsuari FROM usuari WHERE nomUsuari != '".$nomUsuari."';";

$result_usuarios = consultar("localhost", "root", "", $usuarios_query);

$chats_query = "

SELECT tt.who, missatge, dataMissatge 
FROM missatge 
INNER JOIN (
    SELECT  t.who, MAX(dataMissatge) as max_date
    FROM (
        SELECT nomUsuariEmi as who, dataMissatge from missatge WHERE nomUsuariRec = '".$nomUsuari."'
        UNION
        SELECT nomUsuariRec as who, dataMissatge from missatge WHERE nomUsuariEmi= '".$nomUsuari."'
         ) as t
    GROUP BY who
) as tt
ON dataMissatge = tt.max_date; 

";

$result_chats = consultar("localhost", "root", "", $chats_query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missatge</title>
    <link rel="stylesheet" href="../lib/app.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <?php include('../header.php'); ?>
    </header>
    <main>
      

        <p> Usuari:  <?php echo $nomUsuari; ?></p><br>

        <input type="search" list="nombre-usuarios"><br>

        <datalist id="nombre-usuarios">

             <?php 

                while($reg = mysqli_fetch_array($result_usuarios)){     
                       echo " <option value=$reg[nomUsuari]>";
                }

              ?>
        </datalist>


        <?php 

            while($reg = mysqli_fetch_array($result_chats)){

                echo "$reg[who] ";
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

