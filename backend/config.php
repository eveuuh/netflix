<?php 

ob_start();
session_start();
date_default_timezone_set("Europe/London"); //La fonction date_default_timezone_set() définit le décalage horaire par défaut utilisé par toutes les fonctions date/heure.

try {
$con = new PDO("mysql:dbname=simplonfix; host=localhost", "evou", "babybabz");// connexion à la base de donnée. 
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
 catch(PDOException $e) {
    echo("Connexion echouée:" . $e->getMessage());
}

?>

