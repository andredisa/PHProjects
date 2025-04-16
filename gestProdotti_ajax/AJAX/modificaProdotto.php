<?php
include_once("../classes/GestioneProdotti.php");
$gestioneProdotti = new GestioneProdotti();
$response = "";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['idUtente'])) {
    $idUtente = $_SESSION['idUtente'];
} else {
    header("Location: ../index.html");
    exit();
}

if((isset($_GET["id"]) && isset($_GET["nome"]) && isset($_GET["prezzo"]) && isset($_GET["quantita"]) && isset($_GET["tipologia"])) &&
    ($_GET["id"] != "" > 0 && $_GET["nome"] != "" && $_GET["prezzo"] > -1 && $_GET["quantita"] > 0 && $_GET["tipologia"] > 0)){
    $id = $_GET["id"];
    $nome = $_GET["nome"];
    $prezzo = $_GET["prezzo"];
    $quantita = $_GET["quantita"];
    $tipologia = $_GET["tipologia"];

    if(!$gestioneProdotti->checkExistentByID($id)){
        //modifica 
        $gestioneProdotti->setProdottoByID($id, $nome, $prezzo, $quantita, $tipologia);
        $response = array("status" => "Ok", "message" => "Prodotto aggiornato");
    } else {
        $response = array("status" => "Error", "message" => "Prodotto non esistente");
    }
}
else{
    $response = array("status" => "Error", "message" => "Dati mancanti");
}

echo json_encode($response);
?>