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

if((isset($_GET["nome"]) && isset($_GET["prezzo"]) && isset($_GET["quantita"]) && isset($_GET["tipologia"])) &&
    ($_GET["nome"] != "" && $_GET["prezzo"] > -1 && $_GET["quantita"] > 0 && $_GET["tipologia"] > 0)){
    $nome = $_GET["nome"];
    $prezzo = $_GET["prezzo"];
    $quantita = $_GET["quantita"];
    $tipologia = $_GET["tipologia"];

    if($gestioneProdotti->checkExistent($nome)){
        //modifica 
        $gestioneProdotti->setProdotto($nome, $prezzo, $quantita, $tipologia);
        $response = array("status" => "Ok", "message" => "Prodotto aggiornato");
    } else {
        //aggiunge
        $gestioneProdotti->addProdotto($nome, $prezzo, $quantita, $tipologia);
        $response = array("status" => "Ok", "message" => "Prodotto aggiunto");
    }
}
else{
    $response = array("status" => "Error", "message" => "Accedi per continuare");
}

echo json_encode($response);
?>