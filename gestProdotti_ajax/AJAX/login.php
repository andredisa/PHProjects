<?php
include_once("../classes/GestioneUtenti.php");

$gestioneUtenti = new GestioneUtenti();
$response;
$checkID = 0;

if (isset($_GET["username"]) && isset($_GET["password"])) {
    $username = $_GET["username"];
    $password = $_GET["password"];

    if ($username != "" && $password != "") {
        $checkID = $gestioneUtenti->checkCredentials($username, $password);
        if ($checkID != 0) {
            $isActivated = $gestioneUtenti->isActivated($username);
            if ($isActivated) {
                $response = array("status" => "Ok", "message" => "Benvenuto");

                if (!isset($_SESSION)) {
                    session_start();
                }
                $_SESSION["idUtente"] = $checkID;
            }
        } else {
            $response = array("status" => "Error", "message" => "Credenziali errate");
        }
    }
}

echo json_encode($response);
?>