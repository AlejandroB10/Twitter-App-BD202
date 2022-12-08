<?php

include('../conexion.php');

// $publicacions_query = "SELECT * FROM publicacio WHERE nomUsuari != USUARI.nomUsuari AND idHistoria = NULL ORDER BY dataPub DESC";
//$publicacions_query = "SELECT * FROM publicacio WHERE idHistoria IS NULL ORDER BY dataPub DESC";


//$result_publi = consultar("localhost", "root", "", $publicacions_query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="../tailwind.js"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
</head>

<body>
    <header>
        <?php include('../header.php'); ?>
    </header>
    <!-- Creamos boton crear publicaciones -->
    <div class="flex justify-center">
        <a href="crearPub.php">
            <span class="block flex items-center justify-center font-semibold w-40 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                Crear publicación
                <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover" style="width:25px;height:25px">
                </lord-icon>
            </span>
        </a>
    </div>
    <div class="relative min-h-screen  max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-0 shadow-lg rounded-xl mt-16">
        <!-- Publicaciones -->
        <div class="grid items-center justify-center mt-16" id="publications">
            <?php
            $publicacions_query = "SELECT * FROM publicacio WHERE idHistoria IS NULL ORDER BY dataPub DESC";


            $result_publi = consultar("localhost", "root", "", $publicacions_query);
            while ($fila = mysqli_fetch_array($result_publi)) : ?>

                <div class="p-6 bg-white shadow-lg flex justify-start rounded-lg my-8 sm:flex sm:space-x-8 sm:p-8 w-full">

                    <img class="w-20 h-20 flex items-center rounded-full" src="https://tailus.io/sources/blocks/grid-cards/preview/images/avatars/third_user.webp" alt="user avatar" height="220" width="220" loading="lazy">

                    <div class="space-y-4 mt-4 text-center sm:mt-0 sm:text-left w-full">
                        <h2 class="text-gray-800 text-lg mb-1 font-semibold">
                            <?= $fila['titlePub'] ?>
                        </h2>
                        <p class="text-gray-600 text-sm">
                            <?= $fila['textPub'] ?>
                        </p>

                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div class="col-span-2 flex items-center justify-start">
                                <!-- <a href="#" class="text-base font-medium text-gray-500 mr-4" id="comment">
                                        <lord-icon src="https://cdn.lordicon.com/hpivxauj.json" trigger="hover"
                                            style="width:22x;height:22px">
                                        </lord-icon>
                                    </a> -->
                                <a href="#">
                                    <span class="block flex items-center justify-center font-semibold w-32 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                                        Compartir
                                        <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover" class="ml-2" style="width:22px;height:22px;color: rgb(148 163 184);">
                                        </lord-icon>
                                    </span>
                                </a>
                            </div>
                            <div class="flex justify-end">
                                <a href="#" class="text-base font-semibold text-indigo-500">
                                    <?= $fila['nomUsuari'] ?>
                                </a>
                            </div>
                        </div>
                        <hr class="mb-6 mt-2">
                        <div id="comentaris">
                            <input type="text" name="comentari" placeholder="Comentario" class="pl-4 focus mt-1 block w-full border-none bg-gray-100 h-8 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                        </div>
                    </div>
                </div>
            <?php
            endwhile;
            ?>
        </div>
    </div>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>

</html>