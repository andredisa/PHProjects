<?php

class GestioneProdotti
{
    public $mysqli;
    public $currentUserID;
    public $admin;

    /**
     * costruttore
     */
    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "preverifica");
        $this->currentUserID = 0;
        $this->admin;
    }


    /**
     * set dell'id dello user corrente
     */
    public function setUserID($id)
    {
        $this->currentUserID = $id;
        $this->checkAdmin();
    }

    /**
     * Controlla che l'utente sia un admin o meno
     */
    public function checkAdmin()
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM utente WHERE ID=?");
        $stmt->bind_param("i", $this->currentUserID);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if ($user["userType"] == "a") {
            $this->admin = true;
        } else {
            $this->admin = false;
        }
    }

    /**
     * Elimina il prodotto dal DB
     */
    public function deleteProdotto($id)
    {
        #cancella associazioni 
        $stmt = $this->mysqli->prepare("DELETE FROM acquisto WHERE idProdotto=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        #cancella prodotto
        $stmt = $this->mysqli->prepare("DELETE FROM prodotto WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    /**
     * Controlla che il prodotto sia esistente o meno
     */
    public function checkExistent($nome)
    {
        $id = 0;
        $query = $this->mysqli->prepare("SELECT ID FROM prodotto WHERE nome=?");
        $query->bind_param("s", $nome);
        $query->execute();
        $query->bind_result($id);
        $query->fetch();
        $query->close();

        if (!empty($id)) {
            return true;
        }

        return false;
    }

    /**
     * Controlla che il prodotto sia esistente o meno (passando l'ID)
     */
    public function checkExistentByID($id)
    {
        $id = 0;
        $query = $this->mysqli->prepare("SELECT ID FROM prodotto WHERE id=?");
        $query->bind_param("i", $id);
        $query->execute();
        $query->bind_result($id);
        $query->fetch();
        $query->close();

        if (!empty($id)) {
            return true;
        }

        return false;
    }

    /**
     * Aggiunge prodotto al DB
     */
    public function addProdotto($nome, $prezzo, $quantita, $tipologia)
    {
        $query = $this->mysqli->prepare("INSERT INTO prodotto (nome, prezzo, quantita, tipologia) VALUES (?, ?, ?, ?)");
        $query->bind_param("siii", $nome, $prezzo, $quantita, $tipologia);
        $query->execute();
        $query->close();
    }

    /**
     * Modifica il prodotto nel DB
     */
    public function setProdotto($nome, $prezzo, $quantita, $tipologia)
    {
        $query = $this->mysqli->prepare("UPDATE prodotto SET nome = ?, prezzo = ?, quantita = ?, tipologia = ? WHERE nome = ?");
        $query->bind_param("siiis", $nome, $prezzo, $quantita, $tipologia, $nome);
        $query->execute();
        $query->close();
    }

    /**
     * Modifica il prodotto nel DB (passando l'ID)
     */
    public function setProdottoByID($id, $nome, $prezzo, $quantita, $tipologia)
    {
        $query = $this->mysqli->prepare("UPDATE prodotto SET nome = ?, prezzo = ?, quantita = ?, tipologia = ? WHERE id = ?");
        $query->bind_param("siiii", $nome, $prezzo, $quantita, $tipologia, $id);
        $query->execute();
        $query->close();
    }

    /**
     * Effettua l'acquisto del prodotto da parte dell'utente
     */
    public function compraProdotto($idProdotto, $idUtente)
    {
        $query = $this->mysqli->prepare("SELECT * FROM prodotto WHERE id=?");
        $query->bind_param("i", $idProdotto);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        $row = $result->fetch_assoc();
        $quantita = $row["quantita"];
        if ($quantita > 0) {
            $quantita = $quantita - 1;
            //aggiorna quantità
            $query = $this->mysqli->prepare("UPDATE prodotto SET quantita = ? WHERE id = ?");
            $query->bind_param("ii", $quantita, $idProdotto);
            $query->execute();
            $query->close();
            //crea associazione acquisto
            $today = date("d/m/Y");
            $query = $this->mysqli->prepare("INSERT INTO acquisto (idUtente, idProdotto, data) VALUES (?, ?, ?)");
            $query->bind_param("iis", $idUtente, $idProdotto, $today);
            $query->execute();
            $query->close();

            return true;
        } else {
            return false;
        }
    }


    /**
     * Crea JSON della lista di prodotti
     */
    public function parseJSON($query)
    {
        $list = [];
        while (($row = $query->fetch_assoc()) != null) {
            array_push($list, $row);
        }
        return $list;
    }


    /**
     * Crea HTML
     */
    public function stampaProdotti($list)
    {
        $html = "<div id='divProdotti' align='center'>";
        $html .= "<div><table>";
        $html .= "<th>Nome</th><th>Prezzo</th><th>Quantita'</th><th>Tipologia</th>";

        foreach ($list as $prodotto) {

            $html .= "<tr>";

            $html .= "<td><p>" . $prodotto["nome"] . "</p></td>";
            $html .= "<td><p>" . $prodotto["prezzo"] . "</p></td>";
            $html .= "<td><p>" . $prodotto["quantita"] . "</p></td>";
            //tipologia
            $tipologia = "";
            $stmt = $this->mysqli->prepare("SELECT nome FROM tipologia WHERE ID=?");
            $stmt->bind_param("i", $prodotto["tipologia"]);
            $stmt->execute();
            $stmt->bind_result($tipologia);
            $stmt->fetch();
            $stmt->close();
            $html .= "<td><p>" . $tipologia . "</p></td>";

            if ($this->admin) {
                $html .= "<td><button id='" . $prodotto["ID"] . "' onclick='modifica(this)'>MODIFICA</button></td>";
                $html .= "<td><button id='" . $prodotto["ID"] . "' onclick='elimina(this)'>ELIMINA</button></td>";
            } else {
                $html .= "<td><button id='" . $prodotto["ID"] . "' onclick='compra(this)'>COMPRA</button></td>";
            }

            $html .= "</tr>";
        }
        $html .= "</table>";
        if ($this->admin) {
            $html .= "<br><button id='aggiungiProdotto'>AGGIUNGI PRODOTTO</button>";
        }
        $html .= "</div>";

        return $html;
    }
}
