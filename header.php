<div>
    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5">
        <div class="container flex flex-wrap justify-between items-center mx-auto">
            <a href="../home.php" class="flex items-center">
                <img src="../img/logo.svg" class="mr-1 h-5 sm:h-5" alt="Flowbite Logo">
                <span class="self-center text-xl font-semibold whitespace-nowrap">Tinderinfo</span>
            </a>
            <div class="flex items-center md:order-2">
                <span
                    class="self-center text-xl font-semibold whitespace-nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
                <ul
                    class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
                    <li>
                        <a href="../home.php"
                            class="block py-2 pr-4 pl-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0"
                            id="home" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="../BD249608499Y/missatge1.php"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"
                            id="missatge">Mensaje</a>
                    </li>
                    <li>
                        <a href="../BD204305407Z/searchUser.php"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"
                            id="search">Buscador</a>
                    </li>
                    <li>
                        <a href="../BD204305407Z/profile.php"
                            class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0"
                            id="profile">Perfil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</div>

<script src="../lib/jquery-3.6.1.min.js"></script>
<script>
    $('#home').click(function () {
        $('#home').addClass('text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700');
        $('#missatge').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#search').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#profile').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
    });

    $('#missatge').click(function () {
        $('#missatge').addClass('text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700');
        $('#home').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#search').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#profile').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
    });

    $('#search').click(function () {
        $('#search').addClass('text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700');
        $('#missatge').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#home').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#profile').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
    });

    $('#profile').click(function () {
        $('#profile').addClass('text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700');
        $('#missatge').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#search').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
        $('#home').removeClass('text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700');
    });

</script>