<?php
class User2
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
        $req = $bdd->prepare("SELECT valid FROM user WHERE pseudo = ?");
        $req->execute([$this->pseudo]);
        $valid = $req->fetch();
        if ($valid['valid'] == "1") {
            $bool = true;
        }
        return $bool;
    }


    public function verifConect($bdd)
    {
        $req = $bdd->prepare("SELECT * FROM user WHERE pseudo = ? AND mdp = ?");
        $req->execute([$this->pseudo, $this->mdp]);
        $donnee = $req->fetch();

        $this->email = $donnee['email'];

        $count = $req->rowCount();

        if ($count > 0) {
            $bool = $this->verifToken($bdd);
            if ($bool == true) {
                session_start();
                $this->valid = 1;
                $_SESSION['pseudo'] = $this->pseudo;
                $_SESSION['mdp'] = $this->mdp;
                $_SESSION['validation_token'] = $this->valid;
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
