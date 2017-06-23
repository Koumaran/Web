<?php

// Génération d'une chaine aléatoire
function chaine_aleatoire($nb_car, $chaine = 'azertyuiopqsdfghjklmwxcvbn123456789')
{
    $nb_lettres = strlen($chaine) - 1;
    $generation = '';
    $i = -1;
    while (++$i < $nb_car)
    {
        $pos = mt_rand(0, $nb_lettres);
        $car = $chaine[$pos];
        $generation .= $car;
    }
    return $generation;
}

//fonction d'envoie des mails
function send_mail($key, $sujet)
{
	$mail = $_POST['mail'];
	$login = $_POST['identifiant'];
	$entete = "From: jsivanes@student.42.fr";
	if ($sujet === "Activer votre compte")
	{	
		$message = 'Bienvenue sur Camagru,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.

'.URL_ACTIVATION.'?log='.urlencode($login).'&key='.urlencode($key).'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
	}
	if ($sujet === "Mot de pass oublier")
	{
		
		$message = 'Bienvenue sur Camagru,
 
Pour pouvoir vous reconnecter à votre compte, veuillez utiliser le mot de pass ci-dessous:
		'.$key.'
 
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
	}
	$res = mail($mail, $sujet, $message, $entete); //envoi du mail

}
?>