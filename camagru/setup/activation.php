<?php
include('database.php');
include("identification.php");

// Récupération des variables nécessaires à l'activation
$login = $_GET['log'];
$cle = $_GET['key'];
 
// Récupération de la clé correspondant au $login dans la base de données
$stmt = $pdo->prepare("SELECT cle, valid FROM user WHERE name like :login ");
if($stmt->execute(array(':login' => $login)) && $row = $stmt->fetch())
  {
    $clebdd = $row['cle'];	// Récupération de la clé
    $valid = $row['valid']; // $actif contiendra alors 0 ou 1
  }
 
 
// On teste la valeur de la variable $actif récupéré dans la BDD
if($valid == '1') // Si le compte est déjà actif on prévient
  {
     echo "Votre compte est déjà actif !";
  }
else // Si ce n'est pas le cas on passe aux comparaisons
  {
     if($cle == $clebdd) // On compare nos deux clés	
       {
          // Si elles correspondent on active le compte !	
          echo "Votre compte a bien été activé !";
 
          // La requête qui va passer notre champ actif de 0 à 1
          $stmt = $pdo->prepare("UPDATE user SET valid = 1 WHERE name like :login ");
          $stmt->bindParam(':login', $login);
          $stmt->execute();
       }
     else // Si les deux clés sont différentes on provoque une erreur...
       {
          echo "Erreur ! Votre compte ne peut être activé...";
       }
  }
?>