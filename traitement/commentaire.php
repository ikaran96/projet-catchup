<?php 
session_start();


//connexion bdd
require_once('../class/class_bdd.php');

$connexion_bdd = new database('localhost', 'dbs296630', 'root', '');
$bdd = $connexion_bdd->PDOConnexion();


//article

require_once('../class/class_commentaire.php');

$_commentaire = !empty($_POST['commentaire']) ? $_POST['commentaire'] : NULL;
$_id_article= ;
$pseudo=$_SESSION['Pseudo'];
$req=$bdd->prepare("SELECT id_user FROM T_User WHERE Pseudo = $pseudo");
$req->execute();
$donnees=$req->fetch();

$_id_user = $donnees['id_user'];

$comm1= new Commentaire ($_commentaire,$_id_user,$_id_article);
$comm1->addComm($bdd);




