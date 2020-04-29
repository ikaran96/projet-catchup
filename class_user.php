<?php
class User
{
    private $_pseudo;
    private $_email;
    private $_mdp;
    private $_token;
    private $_actif;

    public function __construct($_pseudo, $_mdp)
    {
        $this->_pseudo = $_pseudo;
        $this->_mdp = $_mdp;
        $this->_actif = 0;
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


    public function verifConect($bdd)
    {
        $req = $bdd->prepare("SELECT * FROM T_User WHERE Pseudo = ? AND Mdp = ?");
        $req->execute([$this->_pseudo, $this->_mdp]);
        $donnees = $req->fetch();

        $this->_email = $donnees['Email'];

        $count = $req->rowCount();

        if ($count > 0) {
            $bool = $this->verifToken($bdd);
            if ($bool == true) {
                session_start();
                $this->_actif = 1;
                $_SESSION['Pseudo'] = $this->_pseudo;
                $_SESSION['Mdp'] = $this->_mdp;
                $_SESSION['Actif'] = $this->_actif;
                header("location:index.php");
            } else {
                echo "verifiez la confirmation de votre adresse mail <br>";
                echo '<a href="index.php">Retournez a lacceuil</a>';
            }
        } else {

            //Mauvais identifiant ou mauvais tout cours
            header("location:index6.php");
        }
    }
}
