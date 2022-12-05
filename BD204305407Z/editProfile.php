<?php
session_start();
$user = $_SESSION["user"];
include('../conexion.php');

$user_query = "SELECT * FROM usuari WHERE usuari.nomUsuari = '$user'";

$result = consultar("localhost", "root", "", $user_query);


$reg = mysqli_fetch_array($result);
$user_data = ['usuari' => $reg['nomUsuari'], 'descripcio' => $reg['descripcio'], 'contrasena' => $reg['contrasenya']];

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
        <div class="relative   max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-0 shadow-lg rounded-xl mt-16">
            <div class="px-6">
                <a href="profile.php">
                    <div class="flex">
                        <lord-icon src="https://cdn.lordicon.com/zmkotitn.json" trigger="hover" style="transform:rotateY(180deg);width:30px;height:30px">
                        </lord-icon>
                    </div>
                </a>
                <div class="flex flex-wrap justify-center">
                    <h3 class="text-2xl font-bold">Editar perfil</h3>
                    <div class="w-full flex justify-center mt-6">
                        <div class="relative">
                            <img src="https://tailus.io/sources/blocks/grid-cards/preview/images/avatars/third_user.webp" class="shadow-xl rounded-full align-middle border-none max-w-[150px]" />
                        </div>
                        <div class="absolute">
                            <lord-icon src="https://cdn.lordicon.com/bhfjfgqz.json" trigger="hover" style="width:30px;height:30px;display: flex;margin-top: 125px;margin-left: 100px;">
                            </lord-icon>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center">
                    <!-- <h3 class="text-2xl  font-bold ">Editar perfil</h3> -->
                    <form method="POST" class="mt-5 mb-10">
                        <div>
                            <label for="user_name" class="text-left text-gray-700 ml-2 text-sm">Usuario<span class="text-red-400">*</span></label>
                            <input type="text" id="nom_user" name="user_name" class="pl-4 focus mt-1 block w-80 border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                        </div>
                        <div class="mt-7">
                            <label for="user_name" class="text-gray-700 ml-2 text-sm">Descripción</label>
                            <textarea id="desc_user" name="user_name" class="pl-4 mt-1 block w-80 border-none bg-gray-100 h-32 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                            </textarea>
                        </div>
                        <div class="mt-7">
                            <label for="passw" class="text-gray-700 ml-2 text-sm">Contraseña<span class="text-red-400">*</span></label>
                            <input type="password" id="pass_user" name="passw" class="pl-4 mt-1 block w-80 border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-gray-100">
                        </div>
                        <div class="mt-10">
                            <button type="button" class="bg-blue-500 w-full py-3 rounded-xl text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out 
                             transform hover:-translate-x hover:scale-105" onclick="updateUser()">
                                Actualizar
                            </button>
                        </div>
                    </form>
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
    $(document).ready(function() {
        var jsonData = JSON.parse(JSON.stringify(<?= json_encode($user_data) ?>));
        console.log(jsonData);
        let usuari = jsonData.usuari;
        let descripcio = jsonData.descripcio;
        let password = jsonData.contrasena;

        $('#nom_user').val(usuari);
        $('#desc_user').html(descripcio);
        $('#pass_user').val(password);
    });
    function updateUser() {
        let user = $('#nom_user').val();
        let description = $('#desc_user').val();
        let password = $('#pass_user').val()

        if (!user) {
            alert('Introduzca un usuario');
        }
        if (!password) {
            alert("Introduzca la contrasenya");
        }        
        $.post('userUpdate.php', {
                user: user,
                description: description,
                password: password
            },
            function(data) {
                alert('Se ha actualizado correctamente');
                location.href = 'profile.php';
            }
        );
    }
</script>