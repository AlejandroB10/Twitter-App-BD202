<?php
include('../conexion.php');
$idHistoria = $_GET['idHistorias'];
session_start();
$user = $_SESSION["user"];
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
        <?php
        include('header.php');
        ?>
    </header>
    <main>
        <!-- component -->
        <div
            class="relative min-h-screen  max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-0 shadow-lg rounded-xl mt-16">
            <div class="px-6">
                <div class="flex justify-between">
                    <?php
                    $owners = "SELECT historia.nomUsuari FROM historia WHERE historia.idHistoria = '$idHistoria'";
                    $owner_results = consultar("localhost", "root", "", $owners);
                    $filas = mysqli_fetch_array($owner_results);
                    if ($filas['nomUsuari'] == $user) { ?>
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

                    <?php } else { ?>
                    <a href="profileUser.php?id=<?= $filas['nomUsuari'] ?>">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/zmkotitn.json" trigger="hover"
                                style="transform:rotateY(180deg);width:30px;height:30px">
                            </lord-icon>
                        </div>
                    </a>
                    <?php } ?>
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
                <?php
                $owner = "SELECT historia.nomUsuari FROM historia WHERE historia.idHistoria = '$idHistoria'";
                $owner_result = consultar("localhost", "root", "", $owner);
                $fila = mysqli_fetch_array($owner_result);
                if ($fila['nomUsuari'] == $user) { ?>
                <div class="flex justify-center">
                    <a href="../BD245614068P/crearPubHist.php?id=<?= $idHistoria ?>">
                        <span
                            class="block flex items-center justify-center font-semibold w-40 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                            Crear publicación
                            <lord-icon src="https://cdn.lordicon.com/nocovwne.json" trigger="hover"
                                style="width:25px;height:25px">
                            </lord-icon>
                        </span>
                    </a>
                </div>
                <?php } ?>
                <div class="items-center justify-center">

                    <?php
                    if (isset($_GET['idHistorias'])) {
                        $idHistoria = $_GET['idHistorias'];
                        $show_publi = "SELECT historia.titleHist, publicacio.titlePub, publicacio.textPub, publicacio.nomUsuari 
                            FROM historia 
                            JOIN publicacio ON historia.idHistoria = '$idHistoria' and historia.idHistoria = publicacio.idHistoria 
                            ORDER BY publicacio.dataPub DESC";
                        $result_show_publi = consultar("localhost", "root", "", $show_publi);

                        while ($fila = mysqli_fetch_array($result_show_publi)) { ?>
                    <div
                        class="p-6 bg-white shadow-lg flex justify-start rounded-lg my-8 sm:flex sm:space-x-8 sm:p-8 w-full">

                        <?php
                            if (!empty($fila['img_profile'])) { ?>
                        <img class="w-20 h-20 flex items-center rounded-full" src=<?= $fila['img_profile'] ?>
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

                                    <a href="../BD245614068P/editarPub.php?id=<?= $fila['idPublicacio'] ?>"
                                        class="mr-2">
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
                                    <!-- <a
                                        href="../BD243216941X/insertPublicacion.php?idPublicacio=<?= $fila['idPublicacio'] ?>">
                                        <span
                                            class="block flex items-center justify-center font-semibold w-32 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                                            Compartir
                                            <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover"
                                                class="ml-2" style="width:22px;height:22px;color: rgb(148 163 184);">
                                            </lord-icon>
                                        </span>
                                    </a> -->
                                    <?php } ?>
                                </div>
                                <div class="flex justify-end">
                                    <a class="text-base font-semibold text-indigo-500">
                                        <?= $fila['nomUsuari'] ?>
                                    </a>
                                </div>
                            </div>
                            <hr class="mb-6 mt-2">
                            <p class="text-sm font-semibold">Comentarios: </p>
                            <!-- COMENTARIOS ESCRITOS -->
                            <?php
                            //SELECT PARA MOSTRAR LOS COMENTARIOS
                            $idPub = $fila['idPublicacio'];
                            $res_query = "SELECT * FROM resposta WHERE idPublicacio = '$idPub'";
                            $result_res = consultar("localhost", "root", "", $res_query);
                            while ($f = mysqli_fetch_array($result_res)): ?>

                            <div style="margin-top: 5px;" class="mt-0 flex items-center justify-start">
                                <p class="text-gray-600 text-sm">
                                    <span class="font-semibold">
                                        <?= $f['nomUsuari'] ?>:
                                    </span>
                                    <?= $f['missatgeRes'] ?><span class="block text-sm font-semibold text-indigo-500">
                                            <?php echo date_format(date_create($f['dataRes']), "d-m-Y"); ?>
                                        </span>
                                </p>
                            </div>
                            <?php endwhile ?>
                            <div id="comentaris">
                                <form method="POST"
                                    action="../BD243216941X/insertComent.php?id=<?= $fila['idPublicacio'] ?>">
                                    <input type="text" name="missatge" placeholder="Comentario"
                                        class="pl-4 focus mt-1 block w-full border-none bg-gray-100 h-8 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                                    <!-- mirar de esconder el boton submit -->
                                    <input type="submit" value="">
                                </form>
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