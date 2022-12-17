<?php
session_start();
$user = $_SESSION["user"];
include('../conexion.php');

$user_query = "SELECT * FROM usuari WHERE usuari.nomUsuari = '$user'";
$result = consultar("localhost", "root", "", $user_query);
$reg = mysqli_fetch_array($result);


$count_publi = "SELECT COUNT(publicacio.idPublicacio) AS publicacions FROM usuari JOIN publicacio ON usuari.nomUsuari = '$user' and usuari.nomUsuari = publicacio.nomUsuari";
$result_count_publi = consultar("localhost", "root", "", $count_publi);
$reg_count_publi = mysqli_fetch_array($result_count_publi);

$count_follower = "SELECT COUNT(follow.nomUsuariSeguint) AS seguidores FROM usuari JOIN follow ON usuari.nomUsuari = '$user' and usuari.nomUsuari = follow.nomUsuariSeguint";
$result_count_follower = consultar("localhost", "root", "", $count_follower);
$reg_count_follower = mysqli_fetch_array($result_count_follower);

$count_following = "SELECT COUNT(follow.nomUsuariSeguidor) AS siguiendo FROM usuari JOIN follow ON usuari.nomUsuari = '$user' and usuari.nomUsuari = follow.nomUsuariSeguidor";
$result_count_following = consultar("localhost", "root", "", $count_following);
$reg_count_following = mysqli_fetch_array($result_count_following);

$user_data = [
    'usuari' => $reg['nomUsuari'],
    'descripcio' => $reg['descripcio'],
    'publicacions' => $reg_count_publi['publicacions'],
    'seguidors' => $reg_count_follower['seguidores'],
    'seguint' => $reg_count_following['siguiendo']
];
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
            class="relative min-h-screen max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl mt-16">
            <div class="px-6">
                <div class="flex flex-wrap justify-center">
                    <div class="w-full flex justify-center">
                        <div class="relative">
                            <?php $user_query_img_profile = "SELECT img_profile FROM usuari WHERE usuari.nomUsuari = '$user'";
                            $result_img = consultar("localhost", "root", "", $user_query_img_profile);
                            $reg_img = mysqli_fetch_array($result_img);
                            if (!empty($reg_img['img_profile'])) {
                            ?>
                            <img src=<?= $reg_img['img_profile'] ?>
                            class="shadow-xl rounded-full align-middle border-none absolute -m-16 -ml-20 lg:-ml-16
                            max-w-[150px]" />
                            <?php
                            } else {
                            ?>
                            <img src="../img/profile_picture_default.png" class="shadow-xl rounded-full align-middle border-none absolute -m-16 -ml-20 lg:-ml-16
                            max-w-[150px]" />
                            <?php } ?>
                        </div>
                    </div>
                    <div class="w-full text-center mt-20">
                        <div class="flex justify-center lg:pt-4 pt-8 pb-0">
                            <div class="p-3 text-center">
                                <span class="text-xl font-bold block uppercase tracking-wide text-slate-700"
                                    id="count_publi"></span>
                                <span class="text-sm text-slate-400">Publicaciones</span>
                            </div>
                            <a href="followers.php">
                                <div class="p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-slate-700"
                                        id="count_follower"></span>
                                    <span class="text-sm text-slate-400">Followers</span>
                                </div>
                            </a>
                            <a href="following.php">
                                <div class="p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-slate-700"
                                        id="count_following"></span>
                                    <span class="text-sm text-slate-400">Following</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <h3 class="text-2xl text-slate-700 font-bold leading-normal mb-1" id="nom_user"></h3>
                </div>
                <div class="mt-6 py-6 border-t border-slate-200 text-center">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full px-4">
                            <p class="font-light leading-relaxed text-slate-600 mb-4" id="desc_user"></p>
                        </div>
                    </div>
                </div>
                <!-- middle navigation -->
                <div class="grid grid-cols-4">
                    <button class="mx-auto bg-gray-50 rounded-full px-10 drop-shadow-xl" id="publication_buttom">
                        <lord-icon src="https://cdn.lordicon.com/vufjamqa.json" trigger="hover"
                            style="width:30px;height:30px">
                        </lord-icon>
                        <span class="text-center text-xs block">Publicaciones</span>
                    </button>
                    <button class="mx-auto" id="history_buttom">
                        <lord-icon src="https://cdn.lordicon.com/pnwpbzow.json" trigger="hover"
                            style="width:30px;height:30px">
                        </lord-icon>
                        <span class="text-center text-xs block">Historias</span>
                    </button>
                    <button class="mx-auto" id="compartido_buttom">
                        <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover"
                            style="width:30px;height:30px">
                        </lord-icon>
                        <span class="text-center text-xs block">Compartido</span>
                    </button>
                    <a class="mx-auto" id='configuration_buttom'>
                        <button>
                            <lord-icon src="https://cdn.lordicon.com/hwuyodym.json" trigger="hover"
                                style="width:30px;height:30px">
                            </lord-icon>
                            <span class="text-center text-xs block">Configuración</span>
                        </button>
                    </a>
                </div>

                <!-- Publicaciones -->
                <div class=" items-center justify-center mt-16" id="publications">
                    <?php
                    $publi_query = "SELECT idPublicacio, titlePub, textPub, usuari.nomUsuari, usuari.img_profile, dataPub, idPubliOri FROM publicacio 
                        JOIN usuari ON publicacio.nomUsuari = '$user' and usuari.nomUsuari = publicacio.nomUsuari and idHistoria IS NULL ORDER BY dataPub DESC";
                    $result_publi = consultar("localhost", "root", "", $publi_query);
                    while ($fila = mysqli_fetch_array($result_publi)):
                        if (is_null($fila['idPubliOri'])) {
                    ?>

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
                                        <input type="hidden" name="origin" value="2">
                                    <!-- mirar de esconder el boton submit -->
                                    <input type="submit" value="">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    endwhile;
                    ?>
                </div>

                <!-- Historias -->
                <div style="display: none;" id="history" class="container mt-10 pb-6 mx-auto bg-white">
                    <div class=" flex items-center justify-center">
                        <button
                            class="group h-8 w-48 px-4 mb-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">

                            <a href="../BD245614068P/crearHist.php">
                                <span
                                    class="block flex items-center justify-center font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">
                                    <lord-icon src="https://cdn.lordicon.com/ifqmqwui.json" trigger="hover"
                                        style="width:25px;height:25px">
                                    </lord-icon>Añadir historia
                                </span>
                            </a>

                        </button>
                    </div>
                    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                        <?php
                        $history_query = "SELECT * FROM historia WHERE historia.nomUsuari = '$user'";
                        $result_history = consultar("localhost", "root", "", $history_query);
                        while ($fila = mysqli_fetch_array($result_history)): ?>
                        <a href="showPubli.php?idHistorias=<?= $fila['idHistoria'] ?>">
                            <div class="overflow-hidden rounded-2xl bg-blue-50 p-4 lg:p-6">
                                <div class="flex items-center text-blue-500">
                                    <p class="text-sm font-bold uppercase">
                                        <?= $fila['privacitat']; ?>
                                    </p>

                                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>

                                <h2 class="mt-4 text-xl font-semibold text-slate-800">
                                    <?= $fila['titleHist']; ?>
                                </h2>

                                <p class="mt-4 text-lg text-slate-600">
                                    <?= $fila['textHist']; ?>
                                </p>

                            </div>

                        </a>

                        <?php endwhile;
                        ?>
                    </div>
                </div>

                <!-- Compartir  -->
                <div style="display: none;" id="share" class="items-center justify-center mt-16">
                    <?php
                    $query_share = "SELECT publiOri.idPublicacio, publi.nomUsuari, publi.titlePub, publi.textPub, usuari.img_profile, publiOri.nomUsuari AS nomShare
                    FROM publicacio publi JOIN publicacio publiOri ON publiOri.nomUsuari = '$user' and publi.idPublicacio = publiOri.idPubliOri 
                    JOIN usuari ON publi.nomUsuari = usuari.nomUsuari ORDER BY publiOri.dataPub DESC";
                    $result_share = consultar("localhost", "root", "", $query_share);
                    while ($fila_share = mysqli_fetch_array($result_share)) { ?>
                    <!-- Publicacio retuiteada -->

                    <div class="grid-cols-2 gap-2">
                        <div class="mt-4 col-span-2 text-center sm:mt-0 sm:text-left w-full">
                            <p class="text-sm ml-4">Compartido por: <a href="#"
                                    class="text-base font-semibold text-indigo-500">
                                    <?= $fila_share['nomShare'] ?>
                                </a></p>
                            <hr class="mt-2 mx-4">
                        </div>
                        <div
                            class="p-6 bg-white shadow-lg flex justify-start rounded-lg my-8 sm:flex sm:space-x-8 sm:p-8">

                            <?php
                        if (!empty($fila_share['img_profile'])) { ?>
                            <img class="w-20 h-20 flex items-center rounded-full" src=<?= $fila_share['img_profile'] ?>
                            alt="user avatar" height="220" width="220" loading="lazy">
                            <?php
                        } else {
                    ?>
                            <img class="w-20 h-20 flex items-center rounded-full"
                                src="../img/profile_picture_default.png" alt="user avatar" height="220" width="220"
                                loading="lazy">
                            <?php } ?>

                            <div class="space-y-4 mt-4 text-center sm:mt-0 sm:text-left w-10/12">
                                <h2 class="text-gray-800 text-lg mb-1 font-semibold">
                                    <?= $fila_share['titlePub'] ?>
                                </h2>
                                <p class="text-gray-600 text-sm">
                                    <?= $fila_share['textPub'] ?>
                                </p>

                                <div class="grid grid-cols-3 gap-4 mt-4">
                                    <div class="col-span-2 flex items-center justify-start">
                                        <?php
                        if ($fila_share['nomShare'] == $user) { ?>
                                        <!-- Eliminar una publicacion -->
                                        <a href="../BD245614068P/deletePub.php?id=<?= $fila_share['idPublicacio'] ?>"
                                            class="mr-2">
                                            <span
                                                class="block flex items-center justify-center font-semibold w-48 p-1 text-slate-400 border-2 border-slate-400 rounded-full text-sm transition duration-300 group-hover:text-blue-600">
                                                Dejar de compartir
                                                <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover"
                                                    class="ml-2"
                                                    style="width:22px;height:22px;color: rgb(148 163 184);">
                                                </lord-icon>
                                            </span>
                                        </a>

                                        <?php } else { ?>

                                        <?php } ?>
                                    </div>
                                    <div class="flex justify-end">
                                        <a class="text-base font-semibold text-indigo-500">
                                            <?= $fila_share['nomUsuari'] ?>
                                        </a>
                                    </div>
                                </div>
                                <hr class="mb-6 mt-2">
                                <p class="text-sm font-semibold">Comentarios: </p>
                                <!-- COMENTARIOS ESCRITOS -->
                                <?php
                        //SELECT PARA MOSTRAR LOS COMENTARIOS
                        $idPub = $fila_share['idPublicacio'];
                        $res_query = "SELECT * FROM resposta WHERE idPublicacio = '$idPub'";
                        $result_res = consultar("localhost", "root", "", $res_query);
                        while ($f = mysqli_fetch_array($result_res)): ?>

                                <div style="margin-top: 5px;" class="mt-0 flex items-center justify-start">
                                    <p class="text-gray-600 text-sm">
                                        <span class="font-semibold">
                                            <?= $f['nomUsuari'] ?>:
                                        </span>
                                        <?= $f['missatgeRes'] ?><span
                                                class="block text-sm font-semibold text-indigo-500">
                                                <?php echo date_format(date_create($f['dataRes']), "d-m-Y"); ?>
                                            </span>
                                    </p>
                                </div>
                                <?php endwhile ?>
                                <div id="comentaris">
                                    <form method="POST"
                                        action="../BD243216941X/insertComent.php?id=<?= $fila_share['idPublicacio'] ?>">
                                        <input type="text" name="missatge" placeholder="Comentario"
                                            class="pl-4 focus mt-1 block w-full border-none bg-gray-100 h-8 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                                            <input type="hidden" name="origin" value="2">
                                        <!-- mirar de esconder el boton submit -->
                                        <input type="submit" value="">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <!-- Configuracion -->
                <div style="display: none;" class="mt-16 grid space-y-10" id="configuration">
                    <div class=" flex items-center justify-center">
                        <button
                            class="group h-12 w-64 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">

                            <a href="editProfile.php">
                                <span
                                    class="block flex items-center justify-center font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">
                                    <lord-icon src="https://cdn.lordicon.com/hbigeisx.json" trigger="hover"
                                        class="flex align-baseline mr-2" style="width:30px;height:30px">
                                    </lord-icon>Editar Perfil
                                </span>
                            </a>

                        </button>
                    </div>
                    <div class=" flex items-center justify-center">
                        <button
                            class="group h-12 w-64 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                            <a href="">
                                <span
                                    class="block flex items-center justify-center font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">
                                    <lord-icon src="https://cdn.lordicon.com/kfzfxczd.json" trigger="hover"
                                        class="flex align-baseline mr-2" style="width:30px;height:30px">
                                    </lord-icon>Eliminar Cuenta
                                </span>
                            </a>
                        </button>
                    </div>
                    <div class=" flex items-center justify-center">
                        <button class="group h-12 items-center justify-center w-48 px-6 border-2 border-gray-300 rounded-full transition duration-300 
                                    bg-red-500">
                            <div class="relative flex items-center justify-center">

                                <a href="logout.php">
                                    <span
                                        class="block font-semibold tracking-wide text-white text-sm transition duration-300 sm:text-base">Cerrar
                                        Sesión</span>
                                </a>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>

</html>
<script src="../lib/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function () {
        var jsonData = JSON.parse(JSON.stringify(<?= json_encode($user_data) ?>));
        console.log(jsonData);
        let usuari = jsonData.usuari;
        let descripcio = jsonData.descripcio;

        $('#nom_user').text(usuari);
        $('#desc_user').text(descripcio);
        $('#count_publi').text(jsonData.publicacions);
        $('#count_follower').text(jsonData.seguidors);
        $('#count_following').text(jsonData.seguint);


    });
    $('#publication_buttom').click(function () {
        $('#publications').show();
        $('#history').hide();
        $('#share').hide();
        $('#configuration').hide();
        $('#publication_buttom').addClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#history_buttom').removeClass('bg-gray-50 rounded-full px-12 drop-shadow-xl');
        $('#configuration_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#compartido_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
    });

    $('#history_buttom').click(function () {
        $('#history').show();
        $('#publications').hide();
        $('#share').hide();
        $('#configuration').hide();
        $('#history_buttom').addClass('bg-gray-50 rounded-full px-12 drop-shadow-xl');
        $('#publication_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#configuration_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#compartido_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
    });

    $('#compartido_buttom').click(function () {
        $('#share').show();
        $('#publications').hide();
        $('#history').hide();
        $('#configuration').hide();
        $('#compartido_buttom').addClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#publication_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#history_buttom').removeClass('bg-gray-50 rounded-full px-12 drop-shadow-xl');
        $('#configuration_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
    });

    $('#configuration_buttom').click(function () {
        $('#publications').hide();
        $('#history').hide();
        $('#share').hide();
        $('#configuration').show();
        $('#configuration_buttom').addClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#publication_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
        $('#history_buttom').removeClass('bg-gray-50 rounded-full px-12 drop-shadow-xl');
        $('#compartido_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
    });

    function showPubli(idHistoria) {
        $.post('showPubli.php', {
            idHistorias: idHistoria
        }, function (data) {
            location.href = 'showPubli.php';
        });
    }
</script>