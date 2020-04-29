<?php
class User{
    private $_nom;
    private $_prenom;
    private $_email;
    private $_mdp;
    private $_pseudo;
    private $_token;
    private $_actif;

    public function __construct($_nom, $_prenom, $_pseudo, $_email, $_mdp)
    {
        $this->_nom = $_nom;
        $this->_prenom = $_prenom;
        $this->_email= $_email;
        $this->_mdp = $_mdp;
        $this->_pseudo = $_pseudo;
        $this->_token = substr(str_shuffle(str_repeat("0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN", 40)), 0, 40);
        $this->_valid = 0;
    }



    public function verifToken($bdd)
    {
        $bool = false;
        $req = $bdd->prepare("SELECT Actif FROM T_User WHERE Pseudo = ?");
        $req->execute([$this->_pseudo]);
        $actif = $req->fetch();
        if ($actif['Actif'] == "1") {
            $bool = true;
        }
        return $bool;
    }


    public function signup($bdd)
    {
        if ((!empty($this->_email)) && (!empty($this->_mdp))) {
            $req = $bdd->prepare("SELECT * FROM T_User WHERE Email = ?");
            $req->execute([$this->_email]);
            $count = $req->rowCount();
            if ($count == 0) {
                $req = $bdd->prepare("INSERT INTO T_User SET Nom = ?, Prenom = ?, Email = ?, Mdp = ?, Pseudo = ?,Token = ?, id_typeuser = 3, Actif =0");
                $req->execute([$this->_nom, $this->_prenom, $this->_email, $this->_mdp, $this->_pseudo, $this->_token]);
                echo "Inscription reussie <br> verifiez votre mail";
                // envoyer le mail (a faire)
            } else {
                echo "mail deja pris";
                echo '<a href="connexion.php">Réésayez</a>';
            }
        } else {
            echo "erreur";
        }
    }
}
