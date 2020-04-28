<?php

class user{
    protected $_pseudo;
    protected $_mdp;


    public function __construct($_pseudo,$_mdp){
        $this->_pseudo = $_pseudo;
        $this->_mdp = $_mdp;
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
    

    public function connexion($bdd){
        $pseudo = $this->_pseudo;
        $mdp = $this->_mdp;
        $req = $bdd->prepare("SELECT * FROM USER_POO WHERE pseudo = :pseudo AND mdp = :mdp");
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
            header("location:index.php");
        }
        else
        {
            header("location:index.php?error");
        }
    }



}