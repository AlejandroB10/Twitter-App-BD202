<?php
session_start();
if (isset($_GET['id'])) {
    $user = $_GET['id'];
    $user_id = $_GET['id'];
} else {
    $user = $_SESSION['user'];
}
include('../conexion.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Following</title>
    <link rel="stylesheet" href="../lib/app.css">
    <link rel="stylesheet" type="text/css" href="../alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../alertifyjs/css/themes/default.css">
    <script src="../tailwind.js"></script>
    <script src="../alertifyjs/alertify.js"></script>
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
                    <?php if (isset($user_id)) { ?>
                    <a href="profileUser.php?id=<?= $user_id ?>">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/zmkotitn.json" trigger="hover"
                                style="transform:rotateY(180deg);width:30px;height:30px">
                            </lord-icon>
                        </div>
                    </a>
                    <?php } else { ?>
                    <a href="profile.php">
                        <div>
                            <lord-icon src="https://cdn.lordicon.com/zmkotitn.json" trigger="hover"
                                style="transform:rotateY(180deg);width:30px;height:30px">
                            </lord-icon>
                        </div>
                    </a>
                    <?php } ?>
                </div>
                <div class="flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-center">Siguiendo</h3>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <?php
                    $following_query = "SELECT * FROM follow WHERE follow.nomUsuariSeguidor = '$user'";
                    $result_following = consultar("localhost", "root", "", $following_query);
                    while ($fila = mysqli_fetch_array($result_following)) {
                        $following = $fila['nomUsuariSeguint'];
                        $following_user = "SELECT usuari.img_profile FROM usuari WHERE usuari.nomUsuari = '$following'";
                        $result_following_user = consultar("localhost", "root", "", $following_user);
                        while ($reg = mysqli_fetch_array($result_following_user)) {
                    ?>
                    <div class="container ">
                        <a href="profileUser.php?id=<?= $fila['nomUsuariSeguint'] ?>">
                            <div
                                class="m-auto my-8 w-full max-w-lg items-center justify-center overflow-hidden rounded-2xl bg-blue-100 shadow-xl">
                                <div class="h-24 bg-white"></div>
                                <div class="-mt-20 flex justify-center">
                                    <?php
                            if (!empty($reg['img_profile'])) { ?>
                                    <img class="h-32 rounded-full" src=<?= $reg['img_profile'] ?> />
                                    <?php
                            } else {
                                    ?>
                                    <img class="h-32 rounded-full" src="../img/profile_picture_default.png" />
                                    <?php } ?>
                                </div>
                                <div class="mt-2 mb-1 px-3 text-center text-lg">
                                    <?= $fila['nomUsuariSeguint'] ?>
                                </div>
                                <div class="flex flex-row justify-center items-center">
                                    <a class="text-sm mt-0 mb-3 text-slate-400 font-bold text-center border-2 border-slate-400 rounded-full px-1 py-1 w-24 mt-5"
                                        onclick="following_buttom('<?= $user ?>', '<?= $fila['nomUsuariSeguint'] ?>')">Siguiendo</a>
                                </div>
                            </div>
                        </a>
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
<script src="../lib/jquery-3.6.1.min.js"></script>
<script>

    function following_buttom(user, user_following) {
        var users = JSON.parse(JSON.stringify(<?= json_encode($user_id) ?>));
        console.log(users)
        alertify.confirm("Dejar de seguir",
            "Dejar de seguir, pero si cambias de opinión tendrás que volver a enviar una solicitud para seguir a " + user_following,
            function () {
                $.post('userUnfollow.php', {
                    user: user,
                    user_follo: user_following
                }, function () {
                    if (users === null) {
                        location.href = 'following.php';
                    } else {
                        location.href = 'following.php?id=' + users;
                    }
                })
            },
            function () {
            }
        );
    }

</script>