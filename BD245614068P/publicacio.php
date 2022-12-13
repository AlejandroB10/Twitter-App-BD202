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
    <div
        class="relative min-h-screen max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl mt-16">
        <div class="px-6">
            <!-- Creamos boton crear publicaciones -->
            <div class="flex justify-center">
                <a href="crearPub.php">
                    <span
                        class="block flex items-center justify-center font-semibold w-40 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                        Crear publicación
                        <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover"
                            style="width:25px;height:25px">
                        </lord-icon>
                    </span>
                </a>
            </div>
            <!-- Publicaciones -->
            <div class="items-center justify-center mt-16" id="publications">
                <?php
                $publicacions_query = "SELECT * FROM publicacio WHERE idHistoria IS NULL ORDER BY dataPub DESC";


                $result_publi = consultar("localhost", "root", "", $publicacions_query);

                session_start();
                $user = $_SESSION['user'];

                while ($fila = mysqli_fetch_array($result_publi)):
                    $user_img = $fila['nomUsuari'];
                    $user_query_img_profile = "SELECT img_profile FROM usuari WHERE usuari.nomUsuari = '$user_img'";
                    $result_img = consultar("localhost", "root", "", $user_query_img_profile);
                    $reg_img = mysqli_fetch_array($result_img);
                ?>

                <div class="p-6 bg-white shadow-lg flex justify-start rounded-lg my-8 sm:flex sm:space-x-8 sm:p-8">

                    <?php
                    if (!empty($reg_img['img_profile'])) { ?>
                    <img class="w-20 h-20 flex items-center rounded-full" src=<?= $reg_img['img_profile'] ?>
                    alt="user avatar" height="220" width="220" loading="lazy">
                    <?php
                    } else {
                    ?>
                    <img class="w-20 h-20 flex items-center rounded-full" src="../img/profile_picture_default.png"
                        alt="user avatar" height="220" width="220" loading="lazy">
                    <?php } ?>

                    <div class="space-y-4 mt-4 text-center sm:mt-0 sm:text-left w-10/12">
                        <h2 class="text-gray-800 text-lg mb-1 font-semibold">
                            <?= $fila['titlePub'] ?>
                        </h2>
                        <p class="text-gray-600 text-sm">
                            <?= $fila['textPub'] ?>
                        </p>

                        <div class="grid grid-cols-3 gap-4 mt-4">
                            <div class="col-span-2 flex items-center justify-start">
                                <?php
                    if ($fila['nomUsuari'] == $user) { ?>

                                <a href="../BD245614068P/editarPub.php?id=<?= $fila['idPublicacio'] ?>" class="mr-2">
                                    <span
                                        class="block flex items-center justify-center font-semibold w-28 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                                        Editar
                                        <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover"
                                            class="ml-2" style="width:30px;height:30px;color: rgb(148 163 184);">
                                        </lord-icon>
                                    </span>
                                </a>
                                <a href="../BD245614068P/deletePub.php?id=<?= $fila['idPublicacio'] ?>">
                                    <span
                                        class="block flex items-center justify-center font-semibold w-28 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                                        Borrar
                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover"
                                            style="width:28px;height:28px">
                                        </lord-icon>
                                    </span>
                                </a>
                                <?php } else { ?>
                                <a href="#">
                                    <span
                                        class="block flex items-center justify-center font-semibold w-32 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                                        Compartir
                                        <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover"
                                            class="ml-2" style="width:22px;height:22px;color: rgb(148 163 184);">
                                        </lord-icon>
                                    </span>
                                </a>
                                <?php } ?>
                            </div>
                            <div class="flex justify-end">
                                <a class="text-base font-semibold text-indigo-500">
                                    <?= $fila['nomUsuari'] ?>
                                </a>
                            </div>
                        </div>
                        <hr class="mb-6 mt-2">
                        <div id="comentaris">
                            <input type="text" name="comentari" placeholder="Comentario"
                                class="pl-4 focus mt-1 block w-full border-none bg-gray-100 h-8 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                        </div>
                    </div>
                </div>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>

</html>