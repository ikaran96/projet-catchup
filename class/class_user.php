<?php
class User
{
    private $_pseudo;
    private $_email;
    private $_mdp;
    private $_token;
    private $_actif;
    private $_admin;
    private $_mod;
    private $_user;


    public function __construct($_pseudo, $_mdp)
    {
        $this->_pseudo = $_pseudo;
        $this->_mdp = $_mdp;
        $this->_actif = 0;
        $this->_admin = 1;
        $this->_mod = 1;
        $this->_user = 1;
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


    public function connexion_admin($bdd)
    {
        $req = $bdd->prepare("SELECT * FROM T_User WHERE Pseudo = ? AND Mdp = ? AND id_typeuser=1");
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
                $_SESSION['Admin'] = $this->_admin;
                $_SESSION['id_user']=$donnees['id_user'];
                header("location:../index.php");
            } else {
                echo "verifiez la confirmation de votre adresse mail <br>";
                echo '<a href="index.php">Retournez a lacceuil</a>';
            }
        }
    }    




    public function connexion_mod($bdd)
    {
        $req = $bdd->prepare("SELECT * FROM T_User WHERE Pseudo = ? AND Mdp = ? AND id_typeuser=2");
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
                $_SESSION['Mod'] = $this->_mod;
                $_SESSION['id_user']=$donnees['id_user'];
                header("location:../index.php");
            } else {
                echo "verifiez la confirmation de votre adresse mail <br>";
                echo '<a href="index.php">Retournez a lacceuil</a>';
            }
        }
    }    



    public function connexion_user($bdd)
    {
        $req = $bdd->prepare("SELECT * FROM T_User WHERE Pseudo = ? AND Mdp = ? AND id_typeuser=3");
        $req->execute([$this->_pseudo, $this->_mdp]);
        $donnees = $req->fetch();
        $count = $req->rowCount();

        if ($count > 0) {
            $bool = $this->verifToken($bdd);
            if ($bool == true) {
                session_start();
                $this->_actif = 1;
                $_SESSION['Pseudo'] = $this->_pseudo;
                $_SESSION['Mdp'] = $this->_mdp;
                $_SESSION['Actif'] = $this->_actif;
                $_SESSION['User'] = $this->_user;
                $_SESSION['id_user']=$donnees['id_user'];
                header("location:../index.php");
            } else {
                echo "verifiez la confirmation de votre adresse mail <br>";
                echo '<a href="index.php">Retournez a lacceuil</a>';
            }
        }
    }    
}


