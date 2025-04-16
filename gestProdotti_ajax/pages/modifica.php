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
    $_SESSION["idProdottoModifica"] = $idProdotto;
} else {
    header("Location: ../index.html");
    exit();
}
?>

<html>

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        function updateMessage(message) {
            document.getElementById("message").innerHTML = message;
        }

        $("document").ready(function() {
            $("#modificaProdotto").click(function() {
                let nome = document.getElementById("nomeProdotto").value;
                if (nome != "") {
                    let prezzo = document.getElementById("prezzoProdotto").value;
                    if (prezzo != null || prezzo >= 0) {
                        let quantita = document.getElementById("quantitaProdotto").value;
                        if (quantita != null || quantita >= 0) {
                            let select = document.getElementById("selectTipologia");
                            let tipologia = select.value;
                            if (tipologia > 0) {
                                let id = 0;
                                $.get("../AJAX/getIDProdotto.php", {}, function(data) { //richiesta ID salvato in sessione
                                    if (data["status"] == "Ok") {
                                        id = data["id"];
                                        $.get("../AJAX/modificaProdotto.php", { //richiesta effettiva di modifica
                                            id: id,
                                            nome: nome,
                                            prezzo: prezzo,
                                            quantita: quantita,
                                            tipologia: tipologia
                                        }, function(data) {
                                            updateMessage(data["message"]);
                                        }, "json");
                                    } else {
                                        updateMessage(data["message"]);
                                    }
                                }, "json");
                            } else {
                                updateMessage("Errore: Inserire una tipologia");
                            }
                        } else {
                            updateMessage("Errore: Inserire una quantità");
                        }
                    } else {
                        updateMessage("Errore: Inserire un prezzo");
                    }
                } else {
                    updateMessage("Errore: Inserire un nome");
                }
            });
        });
    </script>
</head>

<body>
    <h1>Modifica prodotto</h1>
    <br>
    Nome: <input type="text" id="nomeProdotto">
    <br>
    Prezzo: <input type="number" id="prezzoProdotto" min=0>
    <br>
    Quantita': <input type="number" id="quantitaProdotto" min=1>
    <br>
    Tipologia: <select id='selectTipologia'>
        <?php
        $mysqli = new mysqli("localhost", "root", "", "preverifica");
        $stmt = $mysqli->prepare("SELECT * FROM tipologia");
        $stmt->execute();
        $query = $stmt->get_result();
        $html = "";
        while (($row = $query->fetch_assoc()) != null) {
            //nome tipologia
            $tipologia = $row["nome"];
            //id tipologia
            $idTipologia = 0;
            $stmt2 = $mysqli->prepare("SELECT ID FROM tipologia WHERE nome = ?");
            $stmt2->bind_param("s", $tipologia);
            $stmt2->execute();
            $stmt2->bind_result($idTipologia);
            $stmt2->fetch();
            $stmt2->close();

            $html .= "<option value='$idTipologia'>$tipologia</option>";
        }
        echo $html;
        ?>
    </select>
    <br>
    <button id="modificaProdotto">INVIA</button>
    <br>
    <button onclick="window.location.href='prodotti.php'">INDIETRO</button>
    <br>
    <div id="divMessage">
        <span id="message"></span>
    </div>
</body>

</html>