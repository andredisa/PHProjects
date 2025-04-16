<?php
include_once("../classes/GestioneUtenti.php");

$gestioneUtenti = new GestioneUtenti();

if (isset($_GET["codice"])) {
    if ($_GET["codice"] != "") {
        $codice = $_GET["codice"];
        $email = explode("_", $codice)[0];

        $gestioneUtenti->activateAccount($codice, $email);
    }
}
?>

<html>
<body>
    <div>
        <h1>ACCOUNT ATTIVATO!</h1>
        <a href="../pages/login.html">Accesso</a>
    </div>
</body>

</html>