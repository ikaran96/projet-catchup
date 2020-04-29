<?php 
session_start();


//connexion bdd
require_once('class_bdd.php');

$connexion_bdd = new database('localhost', 'dbs296630', 'root', '');
$bdd = $connexion_bdd->PDOConnexion();


//inscription

require_once('class_signup.php');

$_pseudo = !empty($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
$_mdp = !empty($_POST['mdp']) ? $_POST['mdp'] : NULL;
$_email = !empty($_POST['email']) ? $_POST['email'] : NULL;
$_nom= !empty($_POST['nom']) ? $_POST['nom'] : NULL;
$_prenom = !empty($_POST['prenom']) ? $_POST['prenom'] : NULL;

$user1= new User ($_nom, $_prenom, $_pseudo, $_email, $_mdp);
$user1->signup($bdd);




