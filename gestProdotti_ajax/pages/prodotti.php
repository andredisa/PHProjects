<?php
include_once("../classes/GestioneProdotti.php");
$gestione = new GestioneProdotti();

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['idUtente'])) {
    $idUtente = $_SESSION['idUtente'];
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

        function elimina(button) {
            if (confirm("Confermare azione? (non sarà possibile tornare indietro!)") == true) {
                let idProdotto = button.id;
                $.get("../AJAX/eliminaProdotto.php", {
                    idProdotto: idProdotto
                }, function(data) {
                    updateMessage(data["message"]);
                }, "json");
            }
        }

        function modifica(button) {
            let idProdotto = button.id;
            window.location.href = "modifica.php?idProdotto=" + idProdotto;
        }

        function compra(button) {
            let idProdotto = button.id;

            $.get("../AJAX/compraProdotto.php", {
                idProdotto: idProdotto
            }, function(data) {
                updateMessage(data["message"]);
            }, "json");
        }

        function createFilter() {
            $("#selectTipologia").hide();
            $("#bottoneRicerca").hide();

            $("#bottoneFiltro").click(function() {
                $("#selectTipologia").toggle();
                $("#bottoneRicerca").toggle();

                $("#bottoneRicerca").click(function() {
                    let tipologia = $("#selectTipologia").val();
                    $.get("../AJAX/getProdotti.php", {
                        tipologia: tipologia
                    }, function(data) {
                        if (data["status"] == "Ok") {
                            let listaProdotti = data["list"];

                            let prodotti = document.getElementById("divProdotti");
                            prodotti.remove();

                            $.get("../AJAX/stampaProdotti.php", {
                                list: listaProdotti
                            }, function(data) {
                                $("body").append(data["html"]);
                            }, "json");
                        }
                    }, "json");
                });
            });
        }

        $(document).ready(function() {
            //lista prodotti
            $.get("../AJAX/getProdotti.php", {
                tipologia: "Tutti"
            }, function(data) {
                if (data["status"] == "Ok") {
                    let listaProdotti = data["list"];

                    //crea HTML da stampare
                    $.get("../AJAX/stampaProdotti.php", {
                        list: listaProdotti
                    }, function(data) {
                        if (data["status"] == "Ok") {
                            $("body").append(data["html"]);
                            createFilter();

                            $("#aggiungiProdotto").click(function() {
                                window.location.href = "aggiungi.php";
                            });
                        }
                    }, "json");
                }

            }, "json");


        });
    </script>

    <style>
        table,
        td,
        tr,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>

<body>
    <button id='bottoneFiltro'>Filtro</button>
    <select id='selectTipologia'>
        <?php
        $mysqli = new mysqli("localhost", "root", "", "preverifica");
        $stmt = $mysqli->prepare("SELECT * FROM tipologia");
        $stmt->execute();
        $query = $stmt->get_result();
        $html = "";
        $html .= "<option value='Tutti'>Tutti</option>"; #default
        while (($row = $query->fetch_assoc()) != null) {
            $tipologia = $row["nome"];
            $html .= "<option value='$tipologia'>$tipologia</option>";
        }
        echo $html;

        ?>
    </select>
    <button id='bottoneRicerca'>Ricerca</button>

    <div id="divMessage">
        <span id="message"></span>
    </div>
    <button onclick="window.location.href='logout.php'">LOGOUT</button>
</body>

</html>