<?php
include('../conexion.php');

$nomUsuari = $_POST['nomUsuari'];
$nomReceptor = $_POST['nomReceptor'];

$missatges_query = "SELECT missatge,dataMissatge,nomUsuariEmi as emisor
                    FROM `missatge`
                    WHERE nomUsuariEmi = '" . $nomUsuari . "' AND nomUsuariRec ='" . $nomReceptor . "'
                        OR nomUsuariEmi = '" . $nomReceptor . "' AND nomUsuariRec ='" . $nomUsuari . "'
                    ORDER BY dataMissatge;";

$result_missatges = consultar("localhost", "root", "", $missatges_query);

$data = array();
while ($row = mysqli_fetch_assoc($result_missatges)){

    $data[] = $row;

}

echo json_encode($data);

?>