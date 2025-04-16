<?php
include_once("../classes/GestioneUtenti.php");
include_once("../classes/Emailer.php");

$gestioneUtenti = new GestioneUtenti();
$emailer = new Emailer();
$response;

$checkID = 0;

if(isset($_GET["username"]) && isset($_GET["password"])){
    $username = $_GET["username"];
    $password = $_GET["password"];
    
    $checkID = $gestioneUtenti->checkCredentials($username, $password);
    if($username != "" && $password != ""){
        if($checkID != 0){
            $response = array("status" => "Error", "message" => "Utente già esistente");
        }
        else{
            $gestioneUtenti->addUser($username, $password);
            $codice = $username."_".md5($username);

            $emailer->setInfo($username, "Attivazione account", '<a href="http://localhost/radicesimone/PreverificaAJAX/Preverifica/pages/activate.php?codice='.$codice.'">ATTIVA ACCOUNT</a>');
            if($emailer->sendEmail()){
                $response = array("status" => "Ok", "message" => "Codice di attivazione inviato");
            }
            else{
                $response = array("status" => "Error", "message" => "Errore nell'invio dell'email");
            }
        }
    }
}

echo json_encode($response);

?>