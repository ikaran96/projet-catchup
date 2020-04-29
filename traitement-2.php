<?php
session_start();


//connexion bdd
require_once('class_bdd.php');

$connexion_bdd = new database('localhost', 'dbs296630', 'root', '');
$bdd = $connexion_bdd->PDOConnexion();

require_once('class_user.php');

$_pseudo = !empty($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
$_mdp = !empty($_POST['mdp']) ? $_POST['mdp'] : NULL;

$user1 = new User($_pseudo, $_mdp);
$user1->verifConect($bdd);
