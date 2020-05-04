<?php
Class Archive {
    private $_titre;
    private $_contenu;
    private $_imgart;
    private $_dateart;
    private $_iduser;
    private $_idarticle;



public function __construct($_titre, $_contenu, $_imgart, $_iduser, $_idarticle){
    $this->_titre=$_titre;
    $this->_contenu=$_contenu;
    $this->_imgart=$_imgart;
    $this->_dateart=date('l jS \of F Y h:i:s A');
    $this->_iduser = $_iduser;
    $this->_idarticle = $_idarticle;
}

public function addArchive($bdd){
    if ((!empty($this->_titre)) && (!empty($this->_contenu))) {        
        $req=$bdd->prepare("INSERT INTO T_Archive_Article SET Date_archivage_art=?, id_user=?, id_article=?,Titre=?,Contenu=?, Images=?");
        $req->execute([$this->_dateart,$this->_iduser,$this->_idarticle, $this->_titre, $this->_contenu, $this->_imgart]);
    header('location:../admin.php');
  }else{
      header('location:../admin.php');
  }

}

public function suppArticle($bdd){
    $req=$bdd->prepare("DELETE FROM T_Article WHERE id_article = ?");
    $req->execute([$this->_idarticle]);
    header('location:../admin.php');
}

}

