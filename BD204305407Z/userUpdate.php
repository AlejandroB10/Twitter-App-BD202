<?php
include('../conexion.php');

session_start();
$user = $_SESSION['user'];

$image_types = array(
    "image/png" => ".png",
    "image/webp" => ".webp",
    "image/jpg" => ".jpg",
    "image/jpeg" => ".jpeg"
);

$dir_subida = '../img/';

if (!empty($_FILES['img_profile'])) {
    $ext = $image_types[$_FILES['img_profile']['type'][0]];
    if ($ext) {
        $name_file = $_FILES['img_profile']['name'][0];
        $filename = uniqid(mt_rand(), true) . $ext;
        $fichero_subido = $dir_subida . $filename;

        if (move_uploaded_file($_FILES['img_profile']['tmp_name'][0], $fichero_subido)) {
            $sql = "SELECT * FROM usuari WHERE nomUsuari = '$user'";
            $resultado = consultar("localhost", "root", "", $sql);
            $hayregistro = mysqli_num_rows($resultado);
            if ($hayregistro == 1) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    //procederemos a borrar el archivo
                    $logo_user = $fila['img_profile'];
                    if (file_exists($logo_user) && is_readable($logo_user)) {
                        unlink($logo_user);
                    }
                }
            }
            $sql_update_photo = "UPDATE usuari SET img_profile = '$fichero_subido' WHERE nomUsuari = '$user'";
            $sql_update_photo = "CALL modifyUserImgProfile('$user', '$fichero_subido')";

            $resultado_insert =  consultar("localhost", "root", "", $sql_update_photo);
        }
    } else {
        $ext_error = 1;
        $txt_error = 'La extensión de alguno de los ficheros no es válida, han de ser en el formato jpg, jpeg, png o webp.';
    }
}

$user = $_POST['user'];
$description = $_POST['description'];
$password = $_POST['password'];

// $update_user = "UPDATE usuari SET usuari.descripcio = '$description', usuari.contrasenya = '$password' WHERE usuari.nomUsuari = '$user'";
$update_user = "CALL modifyUser('$user', '$description', '$password')";

consultar("localhost", "root", "", $update_user);


?>