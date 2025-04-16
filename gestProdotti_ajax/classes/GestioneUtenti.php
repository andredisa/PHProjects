<?php
class GestioneUtenti
{
    public $mysqli;

    /**
     * costruttore
     */
    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "preverifica");
    }

    /**
     * Controlla che le credenziali inserite siano esistenti
     */
    public function checkCredentials($username, $password)
    {
        $userID = 0;
        $query = $this->mysqli->prepare("SELECT ID FROM utente WHERE username=? AND password=?");
        $password = md5($password);
        $query->bind_param("ss", $username, $password);
        $query->execute();
        $query->bind_result($userID);
        $query->fetch();
        $query->close();
        if (!empty($userID)) {
            return $userID;
        }

        return 0;
    }

    /**
     * Aggiunge user al DB
     */
    public function addUser($username, $password)
    {
        $query = $this->mysqli->prepare("INSERT INTO utente (username, password, userType) VALUES (?, ?, ?)");
        $userType = "u";
        $password = md5($password);
        $query->bind_param("sss", $username, $password, $userType);
        $query->execute();
        $query->close();
    }

    /**
     * Attiva account dell'utente
     */
    public function activateAccount($codice, $email){
        $query = $this->mysqli->prepare("UPDATE utente SET codAttivazione = ? WHERE username = ?");
        $query->bind_param("ss", $codice, $email);
        $query->execute();
        $query->close();
    }

    /**
     * Controlla che l'account sia attivato
     */
    public function isActivated($username){
        $check = false;

        $cod = null;
        $query = $this->mysqli->prepare("SELECT codAttivazione FROM utente WHERE username=?");
        $query->bind_param("s", $username);
        $query->execute();
        $query->bind_result($cod);
        $query->fetch();
        $query->close();
        
        if($cod != null){
            $check = true;
        }

        return $check;
    }
}
