<?php
include('setup/database.php');
function send_verif_mail($key)
{
	$mail = $_POST['mail'];
	$login = $_POST['pseudo'];
	$sujet = "Activer votre compte";
	$entete = "From: jsivanes@student.42.fr";
	$message = 'Bienvenue sur VotreSite,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.

'.URL_ACTIVATION.'?log='.urlencode($login).'&key='.urlencode($key).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
$res = mail($mail, $sujet, $message, $entete); //envoi du mail
}
?>