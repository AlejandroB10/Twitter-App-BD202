<?php
    session_start();
    $user = $_SESSION["user"];
    include('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="tailwind.js"></script>
     <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
</head>

<body>
    <header>
        <?php include('header.php'); ?>
    </header>

    <main>
        <div class="relative min-h-screen">
            <div class="grid items-center justify-center mt-16" id="publications">
                <?php
                $publi_query = "SELECT idPublicacio, titlePub, textPub, USUARI.nomUsuari, dataPub FROM PUBLICACIO 
                        JOIN USUARI ON PUBLICACIO.nomUsuari = '$user' and USUARI.nomUsuari = PUBLICACIO.nomUsuari ORDER BY dataPub DESC";
                $result_publi = consultar("localhost", "root", "", $publi_query);
                while ($fila = mysqli_fetch_array($result_publi)) : ?>

                    <div class="p-6 bg-white shadow-lg flex justify-start rounded-lg my-8 sm:flex sm:space-x-8 sm:p-8">

                        <img class="w-20 h-20 flex items-center rounded-full" src="https://tailus.io/sources/blocks/grid-cards/preview/images/avatars/third_user.webp" alt="user avatar" height="220" width="220" loading="lazy">

                        <div class="space-y-4 mt-4 text-center sm:mt-0 sm:text-left w-full">
                            <h2 class="text-gray-800 text-lg mb-1 font-semibold"><?= $fila['titlePub'] ?></h2>
                            <p class="text-gray-600 text-sm"><?= $fila['textPub'] ?></p>

                            <div class="grid grid-cols-3 gap-4 mt-4">
                                <div class="col-span-2 flex items-center justify-start">
                                    <a href="#" class="text-base font-medium text-gray-500 mr-4" id="comment">
                                        <lord-icon src="https://cdn.lordicon.com/hpivxauj.json" trigger="hover" style="width:22x;height:22px">
                                        </lord-icon>
                                    </a>
                                    <a href="#" class="text-base font-medium text-gray-500" id="retuit">
                                        <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover" style="width:22px;height:22px">
                                        </lord-icon>
                                    </a>
                                </div>
                                <div class="flex justify-end">
                                    <a href="#" class="text-base font-semibold text-indigo-500"><?= $fila['nomUsuari'] ?></a>
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
    </main>

    <footer>
        <?php include('footer.php') ?>
    </footer>
</body>

</html>