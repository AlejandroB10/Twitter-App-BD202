<?php
include('../conexion.php');
$idHistoria = $_GET['idHistorias'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <script src="../tailwind.js"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>
    <main>
        <!-- component -->
        <div
            class="relative min-h-screen  max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-0 shadow-lg rounded-xl mt-16">
            <div class="px-6">
                <div class="flex justify-between">
                    <a href="profile.php">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/zmkotitn.json" trigger="hover"
                                style="transform:rotateY(180deg);width:30px;height:30px">
                            </lord-icon>
                        </div>
                    </a>
                    <a href="../BD245614068P/editarHist.php?id=<?= $idHistoria ?>">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover"
                                style="width:40px;height:40px">
                            </lord-icon>
                            <span class="text-center text-xs block">Editar</span>
                        </div>
                    </a>
                    <a href="../BD245614068P/deleteHist.php?id=<?= $idHistoria ?>">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="hover"
                                style="width:40px;height:40px">
                            </lord-icon>
                            <span class="text-center text-xs block">Borrar</span>
                        </div>
                    </a>
                </div>
                <div class="flex flex-col justify-center">
                    <?php
                    $show_title_text = "SELECT historia.titleHist, historia.textHist FROM historia WHERE historia.idHistoria = '$idHistoria'";
                    $result_title = consultar("localhost", "root", "", $show_title_text);
                    while ($fila = mysqli_fetch_array($result_title)) { ?>
                    <h3 class="text-2xl font-bold text-center">
                        <?= $fila['titleHist'] ?>
                    </h3>
                    <div class="py-6 text-center">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full px-4">
                                <p class="font-light leading-relaxed text-slate-600 mb-4">
                                    <?= $fila['textHist'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <!-- Creamos boton crear publicaciones -->
                <div class="flex justify-center">
                    <a href="../BD245614068P/insertPubHis.php?id=<?= $idHistoria ?>">
                        <span
                            class="block flex items-center justify-center font-semibold w-40 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                            Crear publicación
                            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover"
                                style="width:25px;height:25px">
                            </lord-icon>
                        </span>
                    </a>
                </div>
                <div class="grid items-center justify-center">

                    <?php
                    if (isset($_GET['idHistorias'])) {
                        $idHistoria = $_GET['idHistorias'];
                        $show_publi = "SELECT historia.titleHist, publicacio.titlePub, publicacio.textPub, publicacio.nomUsuari 
                            FROM historia 
                            JOIN publicacio ON historia.idHistoria = '$idHistoria' and historia.idHistoria = publicacio.idHistoria 
                            ORDER BY publicacio.dataPub DESC";
                        $result_show_publi = consultar("localhost", "root", "", $show_publi);

                        while ($fila = mysqli_fetch_array($result_show_publi)) { ?>
                    <div class="p-6 bg-white shadow-lg flex justify-start rounded-lg my-8 sm:flex sm:space-x-8 sm:p-8">

                        <?php $user_query_img_profile = "SELECT img_profile FROM usuari WHERE usuari.nomUsuari = '$user'";
                            $result_img = consultar("localhost", "root", "", $user_query_img_profile);
                            $reg_img = mysqli_fetch_array($result_img);
                            if (!empty($reg_img['img_profile'])) {
                        ?>
                        <img class="w-20 h-20 flex items-center rounded-full" src=<?= $reg_img['img_profile'] ?>
                        alt="user avatar" height="220" width="220" loading="lazy">
                        <?php
                            } else {
                        ?>

                        <img class="w-20 h-20 flex items-center rounded-full" src="../img/profile_picture_default.png"
                            alt="user avatar" height="220" width="220" loading="lazy">

                        <?php } ?>

                        <div class="space-y-4 mt-4 text-center sm:mt-0 sm:text-left w-full">
                            <h2 class="text-gray-800 text-lg mb-1 font-semibold">
                                <?= $fila['titlePub'] ?>
                            </h2>
                            <p class="text-gray-600 text-sm">
                                <?= $fila['textPub'] ?>
                            </p>

                            <div class="grid grid-cols-3 gap-4 mt-4">
                                <div class="col-span-2 flex items-center justify-start">
                                    <a href="#" class="text-base font-medium text-gray-500 mr-4" id="comment">
                                        <lord-icon src="https://cdn.lordicon.com/hpivxauj.json" trigger="hover"
                                            style="width:22x;height:22px">
                                        </lord-icon>
                                    </a>
                                    <a href="#" class="text-base font-medium text-gray-500" id="retuit">
                                        <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover"
                                            style="width:22px;height:22px">
                                        </lord-icon>
                                    </a>
                                </div>
                                <div class="flex justify-end">
                                    <a href="#" class="text-base font-semibold text-indigo-500">
                                        <?= $fila['nomUsuari'] ?>
                                    </a>
                                </div>
                            </div>
                            <hr class="mb-6 mt-2">
                            <div style="display: none;" id="comentaris">
                                <input type="text" name="comentari" placeholder="Comentario"
                                    class="pl-4 focus mt-1 block w-80 border-none bg-gray-100 h-8 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>