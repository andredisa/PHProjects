<?php
include_once("../classes/GestioneProdotti.php");

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['idUtente'])) {
    $idUtente = $_SESSION['idUtente'];
} else {
    header("Location: ../index.html");
    exit();
}

$mysqli = new mysqli("localhost", "root", "", "preverifica");
$mysqli->set_charset("utf8");
$query = "";
$response = "";

if (isset($_GET["tipologia"])) {
    $tipologia = $_GET["tipologia"];

    if ($tipologia != "") {
        if ($tipologia == "Tutti") {
            $query = "SELECT * FROM prodotto";
            $stmt = $mysqli->prepare($query);
        } else {
            $query = "SELECT p.* 
            FROM prodotto AS p
            JOIN tipologia AS t ON t.ID = p.tipologia
            WHERE t.nome = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("s", $tipologia);
        }

        $stmt->execute();
        $queryProdotti = $stmt->get_result();

        $gestione = new GestioneProdotti();
        $prodotti = $gestione->parseJSON($queryProdotti);
        $response = array("status" => "Ok", "message" => "Ricerca avvenuta con successo", "list" => $prodotti);
    }
    else{
        $response = array("status" => "Error", "message" => "Errore nella richiesta");
    }
} else {
    $response = array("status" => "Error", "message" => "Errore nella richiesta");
}

echo json_encode($response);
?>