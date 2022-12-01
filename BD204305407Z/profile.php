 <?php
    session_start();
    $user = $_SESSION["user"];
    include('../conexion.php');

    $user_query = "SELECT * FROM USUARI WHERE USUARI.nomUsuari = '$user'";
    $result = consultar("localhost", "root", "", $user_query);
    $reg = mysqli_fetch_array($result);


    $count_publi = "SELECT COUNT(PUBLICACIO.idPublicacio) AS publicacions FROM USUARI JOIN PUBLICACIO ON USUARI.nomUsuari = '$user' and USUARI.nomUsuari = PUBLICACIO.nomUsuari";
    $result_count_publi = consultar("localhost", "root", "", $count_publi);
    $reg_count_publi = mysqli_fetch_array($result_count_publi);

    $count_follower = "SELECT COUNT(FOLLOW.nomUsuariSeguint) AS seguidores FROM USUARI JOIN FOLLOW ON USUARI.nomUsuari = '$user' and USUARI.nomUsuari = FOLLOW.nomUsuariSeguint";
    $result_count_follower = consultar("localhost", "root", "", $count_follower);
    $reg_count_follower = mysqli_fetch_array($result_count_follower);

    $count_following = "SELECT COUNT(FOLLOW.nomUsuariSeguidor) AS siguiendo FROM USUARI JOIN FOLLOW ON USUARI.nomUsuari = 'marguis' and USUARI.nomUsuari = FOLLOW.nomUsuariSeguidor";
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
         <div class="relative min-h-screen max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded-xl mt-16">
             <div class="px-6">
                 <div class="flex flex-wrap justify-center">
                     <div class="w-full flex justify-center">
                         <div class="relative">
                             <img src="https://tailus.io/sources/blocks/grid-cards/preview/images/avatars/third_user.webp" class="shadow-xl rounded-full align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-[150px]" />
                         </div>
                     </div>
                     <div class="w-full text-center mt-20">
                         <div class="flex justify-center lg:pt-4 pt-8 pb-0">
                             <div class="p-3 text-center">
                                 <span class="text-xl font-bold block uppercase tracking-wide text-slate-700" id="count_publi"></span>
                                 <span class="text-sm text-slate-400">Publicaciones</span>
                             </div>
                             <a href="followers.php">
                                <div class="p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-slate-700" id="count_follower"></span>
                                    <span class="text-sm text-slate-400">Followers</span>
                                </div>
                            </a>
                            <a href="following.php">
                                <div class="p-3 text-center">
                                    <span class="text-xl font-bold block uppercase tracking-wide text-slate-700" id="count_following"></span>
                                    <span class="text-sm text-slate-400">Following</span>
                                </div>
                            </a>
                         </div>
                     </div>
                 </div>
                 <div class="text-center mt-2">
                     <h3 class="text-2xl text-slate-700 font-bold leading-normal mb-1" id="nom_user"></h3>
                     <div class="flex flex-row justify-center items-center">
                         <a class="text-sm mt-0 mb-2 text-slate-400 font-bold text-center border rounded-full px-1 py-1 w-16 mt-5">Seguir</a>
                     </div>
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
                         <lord-icon src="https://cdn.lordicon.com/vufjamqa.json" trigger="hover" style="width:30px;height:30px">
                         </lord-icon>
                         <span class="text-center text-xs block">Publicaciones</span>
                     </button>
                     <button class="mx-auto" id="history_buttom">
                         <lord-icon src="https://cdn.lordicon.com/pnwpbzow.json" trigger="hover" style="width:30px;height:30px">
                         </lord-icon>
                         <span class="text-center text-xs block">Historias</span>
                     </button>
                     <button class="mx-auto" id="compartido_buttom">
                         <lord-icon src="https://cdn.lordicon.com/akuwjdzh.json" trigger="hover" style="width:30px;height:30px">
                         </lord-icon>
                         <span class="text-center text-xs block">Compartido</span>
                     </button>
                     <a class="mx-auto" id='configuration_buttom'>
                         <button>
                             <lord-icon src="https://cdn.lordicon.com/hwuyodym.json" trigger="hover" style="width:30px;height:30px">
                             </lord-icon>
                             <span class="text-center text-xs block">Configuración</span>
                         </button>
                     </a>
                 </div>

                 <!-- Publicaciones -->
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

                 <!-- Historias -->
                 <div style="display: none;" id="history" class="container mt-16 pb-6 mx-auto bg-white">
                     <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

                         <?php
                            $history_query = "SELECT * FROM HISTORIA";
                            $result_history = consultar("localhost", "root", "", $history_query);
                            while ($fila = mysqli_fetch_array($result_history)) : ?>
                             <a href="showPubli.php?idHistorias=<?= $fila['idHistoria'] ?>">
                                 <div class="overflow-hidden rounded-2xl bg-blue-50 p-4 lg:p-6">
                                     <div class="flex items-center text-blue-500">
                                         <p class="text-sm font-bold uppercase"><?= $fila['privacitat']; ?></p>

                                         <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                             <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                         </svg>
                                     </div>

                                     <h2 class="mt-4 text-xl font-semibold text-slate-800"><?= $fila['titleHist']; ?></h2>

                                     <p class="mt-4 text-lg text-slate-600"><?= $fila['textHist']; ?></p>

                                 </div>

                             </a>

                         <?php endwhile;
                            ?>
                     </div>
                 </div>

                 <!-- Configuracion -->
                 <div style="display: none;" class="mt-16 grid space-y-10" id="configuration">
                     <div class=" flex items-center justify-center">
                         <button class="group h-12 w-64 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">

                             <a href="editProfile.php">
                                 <span class="block flex items-center justify-center font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">
                                     <lord-icon src="https://cdn.lordicon.com/hbigeisx.json" trigger="hover" class="flex align-baseline mr-2" style="width:30px;height:30px">
                                     </lord-icon>Editar Perfil
                                 </span>
                             </a>

                         </button>
                     </div>
                     <div class=" flex items-center justify-center">
                         <button class="group h-12 w-64 px-6 border-2 border-gray-300 rounded-full transition duration-300 hover:border-blue-400 focus:bg-blue-50 active:bg-blue-100">
                             <a href="">
                                 <span class="block flex items-center justify-center font-semibold tracking-wide text-gray-700 text-sm transition duration-300 group-hover:text-blue-600 sm:text-base">
                                     <lord-icon src="https://cdn.lordicon.com/kfzfxczd.json" trigger="hover" class="flex align-baseline mr-2" style="width:30px;height:30px">
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
                                     <span class="block font-semibold tracking-wide text-white text-sm transition duration-300 sm:text-base">Cerrar Sesión</span>
                                 </a>
                             </div>
                         </button>
                     </div>
                 </div>
             </div>
         </div>
         <!-- </div> -->
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

         $('#nom_user').text(usuari);
         $('#desc_user').text(descripcio);
         $('#count_publi').text(jsonData.publicacions);
         $('#count_follower').text(jsonData.seguidors);
         $('#count_following').text(jsonData.seguint);
         

     });
     $('#comment').click(function() {
         if ($('#comentaris').is(':visible')) {
             $('#comentaris').hide();
         } else {
             $('#comentaris').show();
         }
     })
     $('#publication_buttom').click(function() {
         $('#publications').show();
         $('#history').hide();
         $('#configuration').hide();
         $('#publication_buttom').addClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
         $('#history_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
         $('#configuration_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
     });

     $('#history_buttom').click(function() {
         $('#history').show();
         $('#publications').hide();
         $('#configuration').hide();
         $('#history_buttom').addClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
         $('#publication_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
         $('#configuration_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
     });

     $('#configuration_buttom').click(function() {
         $('#publications').hide();
         $('#history').hide();
         $('#configuration').show();
         $('#configuration_buttom').addClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
         $('#publication_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
         $('#history_buttom').removeClass('bg-gray-50 rounded-full px-10 drop-shadow-xl');
     });

     function showPubli(idHistoria) {
         $.post('showPubli.php', {
             idHistorias: idHistoria
         }, function(data) {
             location.href = 'showPubli.php';
         });
     }
 </script>