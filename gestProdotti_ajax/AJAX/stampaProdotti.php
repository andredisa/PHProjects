<?php
include_once("../classes/GestioneProdotti.php");

$gestione = new GestioneProdotti();
$response = "";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['idUtente'])) {
    $gestione->setUserID($_SESSION["idUtente"]);
} else {
    header("Location: ../index.html");
    exit();
}



if(isset($_GET["list"])){
    $list = $_GET["list"];

    if(count($list) > 0){
        $response = array("status" => "Ok", "message" => "Conversione avvenuta con successo", "html" => $gestione->stampaProdotti($list));
    }
    else{
        $response = array("status" => "Error", "message" => "Nessun prodotto presente");
    }
}

echo json_encode($response);
?>