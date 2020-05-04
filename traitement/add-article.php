<?php 
session_start();


//connexion bdd
require_once('../class/class_bdd.php');

$connexion_bdd = new database('localhost', 'dbs296630', 'root', '');
$bdd = $connexion_bdd->PDOConnexion();


//article

require_once('../class/class_article.php');

$_titre = !empty($_POST['article-title']) ? $_POST['article-title'] : NULL;
$_contenu = !empty($_POST['contenu-article']) ? $_POST['contenu-article'] : NULL;
$_imgart = !empty($_POST['article-photo']) ? $_POST['article-photo'] : NULL;

$pseudo=$_SESSION['Pseudo'];

$req=$bdd->prepare("SELECT id_user FROM T_User WHERE Pseudo = $pseudo");
$req->execute();
$donnees=$req->fetch();

$_auteur = $donnees['id_user'];

$article1= new Article ($_titre, $_contenu, $_imgart,$_auteur);
$article1->addArticle($bdd);




