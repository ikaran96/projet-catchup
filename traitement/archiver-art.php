<?php
session_start();


//connexion bdd
require_once('../class/class_bdd.php');

$connexion_bdd = new database('localhost', 'dbs296630', 'root', '');
$bdd = $connexion_bdd->PDOConnexion();

//archivage

require_once('../class/class_archive.php');

$pseudo=$_SESSION['Pseudo'];
$req=$bdd->prepare("SELECT id_user FROM T_User WHERE Pseudo = $pseudo");
$req->execute();
$donnees=$req->fetch();
$_iduser = $donnees['id_user'];

$_idarticle =$_GET['id'];

$archivage=$bdd->prepare("SELECT * FROM T_Article WHERE id_article=" .$_idarticle);
$archivage->execute();
$archiver=$archivage->fetch();
$_titre= $archiver['Titre'];
$_contenu=$archiver['Contenue'];
$_imgart=$archiver['Images'];



$archive1= new Archive ($_titre, $_contenu, $_imgart, $_iduser, $_idarticle);
$archive1->addArchive($bdd);
$archive1->suppArticle($bdd);