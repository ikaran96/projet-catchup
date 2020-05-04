<?php
Class Article {
    private $_titre;
    private $_contenu;
    private $_imgart;
    private $_dateart;
    private $_pseudo;



public function __construct($_titre, $_contenu, $_imgart, $_auteur){
    $this->_titre=$_titre;
    $this->_contenu=$_contenu;
    $this->_imgart=$_imgart;
    $this->_dateart=date('l jS \of F Y h:i:s A');
    $this->_auteur = $_auteur;
}

public function addArticle($bdd){
    if ((!empty($this->_titre)) && (!empty($this->_contenu))) {        
        $req=$bdd->prepare("INSERT INTO T_Article SET Titre=?, Contenue=?, Images=?,Date_article=?, id_user=?");
        $req->execute([$this->_titre, $this->_contenu, $this->_imgart,$this->_dateart, $this->_auteur]);
    header('location:../admin.php');
  }else{
      header('location:../admin.php');
  }

}

}