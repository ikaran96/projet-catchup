<?php
session_start();


//connexion bdd
require_once('../class/class_bdd.php');

$connexion_bdd = new database('localhost', 'dbs296630', 'root', '');
$bdd = $connexion_bdd->PDOConnexion();

require_once('../class/class_user.php');

$_pseudo = !empty($_POST['pseudo']) ? $_POST['pseudo'] : NULL;
$_mdp = !empty($_POST['mdp']) ? $_POST['mdp'] : NULL;

$user1 = new User($_pseudo, $_mdp);
$user1->connexion_admin($bdd);
$user1->connexion_mod($bdd);
$user1->connexion_user($bdd);
