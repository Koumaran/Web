<?php
if (!file_exists("private"))
	mkdir("private");

$tab = array();
$tab[] = array("name" => "choux", "prix" => "5", "qte" => "4", "cat" => "fr", "img" => "Ressources/choux.jpg");
$tab[] = array("name" => "eclaire chocolat", "prix" => "3", "qte" => "9", "cat" => "fr/dessert", "img" => "Ressources/eclair_choco.jpg");
$tab[] = array("name" => "entrecote", "prix" => "20", "qte" => "2", "cat" => "fr", "img" => "Ressources/entrecote.jpg");
$tab[] = array("name" => "trois couleurs", "prix" => "5", "qte" => "4", "cat" => "asie/dessert", "img" => "Ressources/trois_couleurs.jpg");
$tab[] = array("name" => "bobun", "prix" => "5", "qte" => "4", "cat" => "asie", "img" => "Ressources/bobun.jpg");
file_put_contents("private/product", serialize($tab));
$order = array();
unset($tab);
$tab[] = array("login" => "admin", "passwd" => hash('whirlpool', "epic"), "order" => $order);
$tab[] = array("login" => "user", "passwd" => hash('whirlpool', "user"), "order" => $order);
file_put_contents("private/passwd",serialize($tab));
header("Location: htdocs/index.php");
?>
