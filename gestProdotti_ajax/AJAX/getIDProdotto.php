<?php
$response = "";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['idProdottoModifica'])) {
    $id = $_SESSION["idProdottoModifica"];
    $response = array("status" => "Ok", "message" => "", "id" => $id);
} else {
    $response = array("status" => "Error", "message" => "ID non esistente");
}

echo json_encode($response);
?>