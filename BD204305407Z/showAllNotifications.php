<?php

include('../conexion.php');
session_start();
$user = $_SESSION['user'];

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
        <?php include('header.php'); ?>
    </header>
    <div
        class="relative min-h-screen  max-w-md mx-auto md:max-w-2xl mt-6 min-w-0 break-words bg-white w-full mb-0 shadow-lg rounded-xl mt-16">
        <div class="flex items-center justify-center bg-gradient-to-t  p-6 bg-no-repeat bg-center">
            <div class="w-full">
                <div class="flex flex-col space-y-4">
                    <!-- Item -->
                    <div
                        class="flex justify-between py-6 px-4 rounded-lg bg-white/60 hover:bg-white/80 hover:shadow-lg transition duration-150 ease-linear backdrop-blur-xl rounded-lg shadow">
                        <span class="flex h-3 w-3 absolute -top-1 -right-1">
                            <span
                                class="animate-ping absolute group-hover:opacity-75 opacity-0 inline-flex h-full w-full rounded-full bg-indigo-400 "></span>
                            <span class="relative inline-flex rounded-full h-3 w-8 bg-indigo-500"></span>
                        </span>
                        <div class="flex items-center space-x-4">
                            <img src="https://flowbite.com/docs/images/people/profile-picture-1.jpg"
                                class="rounded-full h-14 w-14" alt="">
                            <div class="flex flex-col space-y-1">
                                <span class="font-bold">Leonard Krashner</span>
                                <span class="text-sm">Yeah same question here too 🔥</span>
                            </div>
                        </div>
                        <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">
                            17m ago
                        </div>
                    </div>
                    <!-- Item -->
                    <!-- Item -->
                    <div
                        class="flex justify-between py-6 px-4 rounded-lg bg-white/60 hover:bg-white/80 hover:shadow-lg transition duration-150 ease-linear backdrop-blur-xl rounded-lg shadow">
                        <div class="flex items-center space-x-4">
                            <img src="https://flowbite.com/docs/images/people/profile-picture-3.jpg"
                                class="rounded-full h-14 w-14" alt="">
                            <div class="flex flex-col space-y-1">
                                <span class="font-bold">Yao</span>
                                <span class="text-sm">Lorem ipsum dolor sit</span>
                            </div>
                        </div>
                        <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">
                            40m ago
                        </div>
                    </div>
                    <!-- Item -->

                    <!-- Item -->
                    <div
                        class="flex justify-between py-6 px-4 rounded-lg bg-white/60 hover:bg-white/80 hover:shadow-lg transition duration-150 ease-linear backdrop-blur-xl rounded-lg shadow">
                        <div class="flex items-center space-x-4">
                            <img src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                class="rounded-full h-14 w-14" alt="">
                            <div class="flex flex-col space-y-1">
                                <span class="font-bold">Lesine</span>
                                <span class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti,
                                    provident</span>
                            </div>
                        </div>
                        <div class="flex-none px-4 py-2 text-stone-600 text-xs md:text-sm">
                            50m ago
                        </div>
                    </div>
                    <!-- Item -->
                </div>
            </div>
        </div>
    </div>
    <footer>
        <?php include('../footer.php'); ?>
    </footer>
</body>

</html>