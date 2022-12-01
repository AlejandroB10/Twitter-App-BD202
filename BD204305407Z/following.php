<?php
session_start();
$user = $_SESSION['user'];
include('../conexion.php'); ?>
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
        <div class="relative min-h-screen  max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-0 shadow-lg rounded-xl mt-16">
            <div class="px-6">
                <div class="flex justify-between">
                    <a href="profile.php">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/zmkotitn.json" trigger="hover" style="transform:rotateY(180deg);width:30px;height:30px">
                            </lord-icon>
                        </div>
                    </a>
                    <a href="#">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/wloilxuq.json" trigger="hover" style="width:40px;height:40px">
                            </lord-icon>
                            <span class="text-center text-xs block">Editar</span>
                        </div>
                    </a>
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-center">Siguiendo</h3>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <?php
                    $following_query = "SELECT * FROM FOLLOW WHERE FOLLOW.nomUsuariSeguidor = '$user'";
                    $result_following = consultar("localhost", "root", "", $following_query);
                    while ($fila = mysqli_fetch_array($result_following)) { ?>
                        <div class="container ">
                            <div class="m-auto my-8 w-full max-w-lg items-center justify-center overflow-hidden rounded-2xl bg-blue-100 shadow-xl">
                                <div class="h-24 bg-white"></div>
                                <div class="-mt-20 flex justify-center">
                                    <img class="h-32 rounded-full" src="https://media.istockphoto.com/vectors/male-profile-flat-blue-simple-icon-with-long-shadow-vector-id522855255?k=20&m=522855255&s=612x612&w=0&h=fLLvwEbgOmSzk1_jQ0MgDATEVcVOh_kqEe0rqi7aM5A=" />
                                </div>
                                <div class="mt-2 mb-1 px-3 text-center text-lg"><?= $fila['nomUsuariSeguint'] ?></div>
                                <div class="flex flex-row justify-center items-center">
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-24 mt-5">Siguiendo</a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>