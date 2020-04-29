<?php

require_once("class_user.php");
require_once("class_bdd.php");

$token = $_GET['activation'];
$connexion_bdd = new database('localhost', 'dbs296630', 'root', '');
$bdd = $connexion_bdd->PDOConnexion();


$req = $bdd->prepare("SELECT * FROM T_User WHERE Token = ?");
$req->execute([$token]);
$count = $req->rowCount();
if ($count > 0) {
    $req = $bdd->prepare("UPDATE T_User SET Actif = ? WHERE Token = ?");
    $req->execute([1, $token]);
    echo "Le mail a bien été validé connectez vous pour acceder a la page admin <br>";
    echo '<a href="index.php">COnectez vous</a>';
}
