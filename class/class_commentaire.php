<?php
Class Commentaire {
    private $_commentaire;
    private $_datecomm;
    private $_id_user;
    private $_id_article;



public function __construct($_commentaire,$_id_user,$_id_article){
    $this->_commentaire=$_commentaire;
    $this->_datecomm=date('l jS \of F Y h:i:s A');
    $this->_id_user = $_id_user;
    $this->_id_article = $_id_article;
}

public function addComm($bdd){
    if ((!empty($this->_commentaire))) {        
        $req=$bdd->prepare("INSERT INTO T_Commentaires SET Commentaire=?, Date_comm=?, id_article=?, id_user=?");
        $req->execute([$this->_commentaire, $this->_datecomm, $this->_id_article,$this->_id_user]);
    header('location:../blogpost.php');
  }

}

}