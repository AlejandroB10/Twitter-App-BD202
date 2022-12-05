<?php

session_start();
$nomUsuari = 'tuti';

include('../conexion.php');
// include('chat.php');


$usuarios_query = "SELECT nomUsuari FROM usuari WHERE nomUsuari != '" . $nomUsuari . "';";

$result_usuarios = consultar("localhost", "root", "", $usuarios_query);

$chats_query = "

SELECT tt.who, missatge, dataMissatge 
FROM missatge 
INNER JOIN (
    SELECT  t.who, MAX(idMissatge) as max_id
    FROM (
        SELECT nomUsuariEmi as who, idMissatge from missatge WHERE nomUsuariRec = '" . $nomUsuari . "'
        UNION
        SELECT nomUsuariRec as who, idMissatge from missatge WHERE nomUsuariEmi= '" . $nomUsuari . "'
         ) as t
    GROUP BY who
) as tt
ON idMissatge = tt.max_id
ORDER BY dataMissatge DESC;

";

$result_chats = consultar("localhost", "root", "", $chats_query);

$contactonuevo_query = "


SELECT nomUsuari from usuari WHERE nomUsuari != '" . $nomUsuari . "' AND nomUsuari NOT IN(
    SELECT who FROM
    (SELECT nomUsuariEmi as who from missatge WHERE nomUsuariRec = '" . $nomUsuari . "'
            UNION
    SELECT nomUsuariRec as who from missatge WHERE nomUsuariEmi= '" . $nomUsuari . "')as t
    GROUP BY who)
    

";

$result_contactonuevo = consultar("localhost", "root", "", $contactonuevo_query);



function addcontacto($who, $dataMissatge, $missatge, $nomUsuari)
{

?>
    <div id="<?= $who ?>" onclick=contactopulsado1(<?php echo json_encode($who) ?>,<?php echo json_encode($nomUsuari) ?>) class="px-3 flex items-center bg-grey-light cursor-pointer">
        <div>
            <img class="h-12 w-12 rounded-full" src="https://darrenjameseeley.files.wordpress.com/2014/09/expendables3.jpeg" />
        </div>
        <div class="ml-4 flex-1 border-b border-grey-lighter py-4">
            <div class="flex items-bottom justify-between">
                <p class="text-grey-darkest">
                    <?= $who ?>
                </p>
                <p class="text-xs text-grey-darkest">
                    <?= $dataMissatge ?>
                </p>
            </div>
            <p class="text-grey-dark mt-1 text-sm">
                <?= $missatge ?>
            </p>
        </div>

    </div>

<?php

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missatge</title>
    <link rel="stylesheet" href="../lib/app.css">
    <script src="../tailwind.js"></script>
</head>

<body>
    <header>
        <?php include('../header.php'); ?>
    </header>
    <main>
        <div>
            <div class="w-full h-32"></div>

            <div class="container mx-auto" style="margin-top: -128px;">
                <div class="h-screen">
                    <div class="flex border border-grey rounded shadow-lg h-full">

                        <!-- Left -->
                        <div class="w-1/3 border flex flex-col">


                            <!-- BARRA DE BÚSQUEDA -->
                            <div class="py-2 px-2 bg-grey-lightest">
                                <form class="flex items-center" method="POST">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>


                                        <input type="text" name="inputNombre" id="simple-search" list="nombre-usuarios" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" autocomplete="false">
                                        <datalist id="nombre-usuarios">

                                            <?php

                                            $personas_desconicidas = array();
                                            while ($reg = mysqli_fetch_array($result_contactonuevo)) {
                                                echo " <option value=$reg[nomUsuari]>";
                                                $personas_desconicidas[] = $reg['nomUsuari'];
                                            }

                                            ?>
                                        </datalist>
                                    </div>
                                    <input type="submit" value="Buscar" name="botonBuscar" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                </form>

                            </div>

                            <!-- CONTACTOS -->
                            <div class="bg-grey-lighter flex-1 overflow-auto">
                                <?php

                                if (isset($_POST['botonBuscar'])) {

                                    $nomNou = $_POST["inputNombre"];

                                    if (in_array($nomNou, $personas_desconicidas)) {

                                        addcontacto($nomNou, "?", "*** NO HAY MENSAJES ***", $nomUsuari);
                                    }
                                }

                                while ($reg = mysqli_fetch_array($result_chats)) {

                                    addcontacto($reg['who'], $reg['dataMissatge'], $reg['missatge'], $nomUsuari);
                                }

                                ?>

                            </div>

                        </div>

                        <!-- Missatges -->
                        <div id="chat" class="w-2/3 border flex flex-col">


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include('../footer.php') ?>
    </footer>
</body>



<script>
    function contactopulsado1(name, nomU) {

        //call ajax
        var ajax = new XMLHttpRequest();
        var method = "POST";
        var url = "getchat.php";
        var param = 'nomUsuari=' + nomU + '&nomReceptor=' + name;
        var asynchronous = true;


        ajax.open(method, url, asynchronous);

        ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");

        //sending ajax XMLHttpRequest
        ajax.send(param);

        // recieve esponse from getchat.php
        ajax.onreadystatechange = function() {


            if (this.readyState == 4 && this.status == 200) {


                var data = JSON.parse(this.responseText);
                console.log(data);

                //  var html = 'holaaaaa'+name;

                var html = `  <div class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">
                                <div class="flex items-center">
                                    <div>
                                        <img class="w-10 h-10 rounded-full" src="https://darrenjameseeley.files.wordpress.com/2014/09/expendables3.jpeg" />
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-grey-darkest">
                                           ` + name + `
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div class="flex-1 overflow-auto" style="background-color: #c0d6eb">
                                <div class="py-2 px-3">

                                    <div class="flex justify-center mb-4">
                                        <div class="rounded py-2 px-4" style="background-color: #FCF4CB">
                                            <p class="text-xs">
                                                Messages to this chat and calls are now secured with end-to-end encryption. Tap for more info.
                                            </p>
                                        </div>
                                    </div>

                `

                for (var a = 0; a < data.length; a++) {

                    var nomEmissor = data[a].emisor;
                    var missatge = data[a].missatge;
                    var dataM = data[a].dataMissatge;


                    if (nomEmissor == name) {

                        html += `

                        <div class="flex mb-2">
                            <div class="rounded py-2 px-3" style="background-color: #F2F2F2">
                                <p class="text-sm mt-1">
                                      ` + missatge + `
                                </p>
                                <p class="text-right text-xs text-grey-dark mt-1">
                                      ` + dataM + `
                                </p>
                            </div>
                        </div>
                        `

                    } else {


                        html += `
                                    <div class="flex justify-end mb-2">
                                        <div class="rounded py-2 px-3" style="background-color: #E2F7CB">
                                            <p class="text-sm mt-1">
                                            ` + missatge + `
                                            </p>
                                            <p class="text-right text-xs text-grey-dark mt-1">
                                              ` + dataM + `
                                            </p>
                                        </div>
                                    </div>

                               `


                    }
                }
                html += `

                                </div>
                            </div>

                            <!-- Input -->
                           
                               
                               <label for="chat" class="sr-only">Your message</label>
                                <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                                    <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <button type="button" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <input id="inputchat"  rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..."></textarea>
                                    <button type="submit" id="botonmissatge" onclick=enviarmissate("` + nomU + `","` + name + `") class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                        <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                    </button>
                                </div>
                              
                           `;

                document.getElementById("chat").innerHTML = html;

            }
        }

    }

</script>

<script>
    function enviarmissate(nomU, nomR) {

        var missatge = document.getElementById('inputchat').value;
        //call ajax
        var ajax = new XMLHttpRequest();
        var method = "POST";
        var url = "insertMissatge.php";
        var param = 'nomUsuari=' + nomU + '&nomReceptor=' + nomR + '&missatge=' + missatge;
        var asynchronous = true;


        ajax.open(method, url, asynchronous);

        ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");

        //sending ajax XMLHttpRequest
        ajax.send(param);

        ajax.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
               
                contactopulsado1(nomR, nomU)
            }

        }

    }
</script>

</html>