<?php

class User{
    protected $_pseudo;
    protected $_mdp;
    protected $_typeuser1;
    protected $_typeuser2;
    protected $_typeuser3;


    public function __construct($_pseudo,$_mdp){
        $this->_pseudo = $_pseudo;
        $this->_mdp = $_mdp;
        $this->_typeuser1 = 1;
        $this->_typeuser2 = 2;
        $this->_typeuser3 = 3;
    }

    //getters
    public function getPseudo(){
        return $this->_pseudo;
    }

    public function getMdp(){
        return $this->_mdp;
    }

  
    //setters
    public function setPseudo($Pseudo){
        $this->_pseudo = $Pseudo;
       
    }
    public function setMdp($Mdp){
        $this->_mdp = $Mdp;
       
    }
    

    public function connexion_admin($bdd){
        $pseudo = $this->_pseudo;
        $mdp = $this->_mdp;
        $req = $bdd->prepare("SELECT * FROM T_User WHERE pseudo = :pseudo AND mdp = :mdp");
        $req->execute(array(
                    'pseudo' =>  $this->_pseudo,
                    'mdp' => $this->_mdp
        ));

        $count = $req->rowCount();
        if($count > 0)
        {
            session_start();
            $_SESSION['pseudo'] =  $this->_pseudo;
            $_SESSION['mdp'] = $this->_mdp;
            $_SESSION['admin'] =  $this->_typeuser1;
            header("location:index.php");
        }
        else{
            header("location:index.php?error");
        }
    }


    public function connexion_mod($bdd){
        $pseudo = $this->_pseudo;
        $mdp = $this->_mdp;
        $req = $bdd->prepare("SELECT * FROM T_User WHERE pseudo = :pseudo AND mdp = :mdp AND id_typeuser = 2");
        $req->execute(array(
                    'pseudo' =>  $this->_pseudo,
                    'mdp' => $this->_mdp
        ));

        $count = $req->rowCount();
        if($count > 0)
        {
            session_start();
            $_SESSION['pseudo'] =  $this->_pseudo;
            $_SESSION['mdp'] = $this->_mdp;
            $_SESSION['mod'] =  $this->_typeuser2;
            header("location:index.php");
        }else{
            header("location:index.php?error");
        }
    }


    public function connexion_user($bdd){
        $pseudo = $this->_pseudo;
        $mdp = $this->_mdp;
        $req = $bdd->prepare("SELECT * FROM T_User WHERE pseudo = :pseudo AND mdp = :mdp AND id_typeuser = 3");
        $req->execute(array(
                    'pseudo' =>  $this->_pseudo,
                    'mdp' => $this->_mdp
        ));

        $count = $req->rowCount();
        if($count > 0)
        {
            session_start();
            $_SESSION['pseudo'] =  $this->_pseudo;
            $_SESSION['mdp'] = $this->_mdp;
            $_SESSION['user'] =  $this->_typeuser3;
            header("location:index.php");
        }else{
            header("location:index.php?error");
        }
    }
}