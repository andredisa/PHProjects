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

if (isset($_GET["idProdotto"])) {
    $idProdotto = $_GET["idProdotto"];
    $check = $gestioneProdotti->compraProdotto($idProdotto, $idUtente);
    if($check){
        $response = array("status" => "Ok", "message" => "Acquisto completato!");
    }
    else{
        $response = array("status" => "Error", "message" => "Scorte del prodotto terminato!");
    }
   
} else {
    $response = array("status" => "Error", "message" => "ID non inserito");
}

echo json_encode($response);
