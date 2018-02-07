<?php
include('config/identification.php');
include('function/error.php');
include('function/function_1.php');


//on verifie si l'utilisateur n'est pas déja connecter
if ($id!=0) erreur('Vous ne pouvez pas accéder à cette page si vous êtes connecté');

if (isset($_POST['reminder'])) //renouvellement mot de pass
{
	if (empty($_POST['identifiant']) || empty($_POST['mail']))
	{
		redirect("index.php", '<p>une erreur s\'est produite pendant votre identification pour renouvellement du mot de pass.
		Vous devez remplir tous les champs</p>
		<p>Cliquez <a href="index.php">ici</a> pour revenir</p>');
	}
	elseif (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		$query = $pdo->prepare('SELECT id_user, name, mail, cle FROM User WHERE name = :identifiant;');
		$query->bindValue(':identifiant', $_POST['identifiant'], PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		$query->CloseCursor();
		if ($data['name'] == $_POST['identifiant'] && $data['mail'] == $_POST['mail'])
		{
			$pass = chaine_aleatoire(6);
			$hash = hash("whirlpool", $pass);
			$query = $pdo->prepare('UPDATE User SET password = :hash WHERE name = :login');
			$query->execute(array(':hash' => $hash, ':login' => $data['name']));
			send_mail($pass, "Mot de pass oublier");
			redirect("index.php", "Un mail vous a etait envoyer avec un nouveau mot de pass!");
		}
		else
		{
			redirect("index.php", '<p>Identifiant ou mail non reconnu!</p>
			<p>Cliquez <a href="index.php">ici</a></p>');
		}
	}
	else
	{
		redirect("index.php", '<p>Veuillez saisir une adresse email valide.</p>
	<p>Cliquez <a href="index.php">ici</a></p>');
	}
}
else if (isset($_POST['login'])) //connexion
{
    if (empty($_POST['identifiant']) || empty($_POST['password']))
    {
       	redirect("index.php", '<p>une erreur s\'est produite pendant votre identification.
		Vous devez remplir tous les champs</p>
		<p>Cliquez <a href="index.php">ici</a> pour revenir</p>');
    }
    else //On check le mot de passe
    {
       	$query=$pdo->prepare('SELECT id_user, name, password, portrait, rang, valid
       	FROM User WHERE name = :pseudo');
       	$query->bindValue(':pseudo',$_POST['identifiant'], PDO::PARAM_STR);
       	$query->execute();
     	$data=$query->fetch();
		$query->CloseCursor();
		if ($data['password'] == hash('whirlpool', $_POST['password'])) // Acces OK !
		{
			if ($data['valid'] == 1)
			{
				$_SESSION['connected'] = 1;
				$_SESSION['pseudo'] = $data['name'];
	    		$_SESSION['rang'] = $data['rang'];
	   			$_SESSION['id'] = $data['id_user'];
	   			$_SESSION['portrait'] = $data['portrait'];
	   	 		redirect("index.php?page=galerie.php", 0);
			}
			else
			{
	    		redirect("index.php", '<p>Votre compte n\'est pas activer, veuillez activer votre compte graçe au mail que vous avez reçu!<p>Cliquez <a href="index.php">ici</a></p>');
			}  
		}
		else // Acces pas OK !
		{
	    	redirect("index.php", '<p>Une erreur s\'est produite 
	    	pendant votre identification.<br /> Le pseudo ou le  mot de passe
           	entré n\'est pas correcte.</p><p>Cliquez <a href="index.php">ici</a></p>');;
		}
	}
}
else if (isset($_POST['register'])) //inscription
{
	if (empty($_POST['identifiant']) || empty($_POST['password']) || empty($_POST['mail']))
	{
		echo '<p>une erreur s\'est produite pendant votre enregistrement.
		Vous devez remplir tous les champs obligatoire</p>
		<p>Cliquez <a href="index.php">ici</a> pour revenir</p>';
	}
	else if (!ctype_alnum($_POST['password']) || strlen($_POST['password']) < 6)
	{
			echo '<p>Votre mot de pass doit contenir au moin un chiffre et une lettre et faire plus de 6 charactères.</p>
		<p>Cliquez <a href="index.php">ici</a> pour revenir</p>';
	}
	else if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		$query = $pdo->prepare('SELECT id_user, name FROM User WHERE name = :pseudo');
		$query->bindValue(':pseudo', $_POST['identifiant'], PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		$query->CloseCursor();
		if ($data['name'] === $_POST['identifiant'])
		{
			redirect("index.php", '<p>Cet identifiant n\'est pas disponible. Veuillez choisir un autre identifiantt.</p>
			<p>Cliquez <a href="index.php">ici</a></p>');
		}
		else
		{
			$pass =hash('whirlpool', $_POST['password']);
			$key = md5(microtime(TRUE)*100000);
			$query = sprintf("INSERT INTO User (name, password, mail, rang, cle, valid) 
				VALUES ('%s', '%s', '%s', '0', '%s', '0')", $_POST['identifiant'], $pass, $_POST['mail'], $key);
			try
			{
				$pdo->exec($query);
			}
			catch(PDOExecption $e)
			{
				echo ("Erreur ajout de ".$_POST['identifiant']." : ".$e->getMessage());
			}
			//fonction d'envoi d'email
			$str = send_mail($key, "Activer votre compte");
			redirect("index.php", '<p>Bravo! Votre compte a était créé. Pensez a
			 l\'activer avant de vous connecetez.</p> Cliquez <a href="index.php">ici</a></p>'.'<p>'.$str.'</p>');
			}
	}
	else
	{
		redirect("index.php", '<p>Veuillez saisir une adresse email valide.</p>
		<p>Cliquez <a href="index.php">ici</a></p>');
	}
}
$pdo = NULL;
?>