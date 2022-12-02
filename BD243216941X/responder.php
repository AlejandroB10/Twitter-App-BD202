<?php
    session_start();
    $user = $_SESSION["user"];
    include('../conexion.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Import necesario para el tailwind -->
    <script src="../tailwind.js"></script>
    <script src="https://cdn.lordicon.com/qjzruarw.js"></script>
</head>

<body>

    <!-- component -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css" />

    <!-- This is an example component -->
    <div class="max-w-2xl mx-auto">

        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Comentario
            </label>
        <textarea id="message" rows="4"
            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Inserte su comentario..."></textarea>

        <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    </div>

</body>

</html>