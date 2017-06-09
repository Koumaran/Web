<?php
include('setup/identification.php');
include('function/error.php');
include('function/verif_function.php');
//on verifie si l'utilisateur n'est pas déja connecter
if ($id!=0) erreur('Vous ne pouvez pas accéder à cette page si vous êtes connecté');
if (!isset($_POST['pseudo'])) //page formulaire de connexion
{
	?><div style="margin-top: 20%;">
	<form  id="form_connect" method="post" action="index.php?page=connexion.php">
	<fieldset>
	<legend>Connexion</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="test" id="pseudo" /></br>
	<label for="password">Mot de pass :</label><input type="password" name="password" id="password" /></br>
	</p>
	<input type="submit" name="connecter" value="Se connecter" />
	<input type="submit" name="oublier" value="Mot de pass oublié?" /></fieldset>
	</form>
	<form id="form_register" method="post" action="index.php?page=register.php">
	<fieldset>
	<legend><bold>Inscription</bold></legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="test" id="pseudo" /></br>
	<label for="password">Mot de pass :</label><input type="password" name="password" id="password" /></br>
	<label for="mail">E-Mail :</label><input type="mail" name="mail" id="mail" />
	</p>
	<input type="submit" value="S'inscrire" />
	</fieldset>
	</form>
	</div>
	<?
}
elseif (isset($_POST['oublier'])) //page formulaire mot de pass oublier
{
	?><div style="margin-top: 20%;">
	<form id="form_oublier" method="post" action="index.php?page=connexion.php">
	<fieldset>
	<legend>Mot de pass oublié</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="test" id="pseudo" /></br>
	<label for="mail">E-Mail :</label><input type="mail" name="mail" id="mail" /></br>
	</p>
	<input type="submit" name="Valider" value="Valider" />
	</fieldset>
	</form>
	</div>
<?
}
elseif (isset($_POST['Valider'])) //renouvellement mot de pass
{
	$message = '';
	if (empty($_POST['pseudo']) || empty($_POST['mail']))
	{
		$message = '<p>une erreur s\'est produite pendant votre identification pour renouvellement du mot de pass.
		Vous devez remplir tous les champs</p>
		<p>Cliquez <a href="index.php">ici</a> pour revenir</p>';
	}
	elseif (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		$query = $pdo->prepare('SELECT id, name, mail FROM user WHERE name = :pseudo AND mail = :mail');
		$query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$query->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
		$query->execute();
		$data = $query->fetch();
		$query->CloseCursor();
		if ($data['name'] === $_POST['pseudo'])
		{
			/*a faire envoyer l'eamil */
		}
		else
		{
			$message = '<p>Identifiant ou mail erroné</p>
			<p>Cliquez <a href="index.php">ici</a></p>';
		}
	}
	else
	{
			$message = '<p>Veuillez saisir une adresse email valide.</p>
	<p>Cliquez <a href="index.php">ici</a></p>';
	}
}
else
{
	$message='';
	//si l'utilisateur a cliquer sur mot de pass oublié
    if (empty($_POST['pseudo']) || empty($_POST['password'])) //Oublie d'un champ
    {
       	$message = '<p>une erreur s\'est produite pendant votre identification.
		Vous devez remplir tous les champs</p>
		<p>Cliquez <a href="index.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
       	$query=$pdo->prepare('SELECT id, name, password
       	FROM user WHERE name = :pseudo');
       	$query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
       	$query->execute();
     	$data=$query->fetch();
		if ($data['password'] == hash('whirlpool', $_POST['password'])) // Acces OK !
		{
			if ($data['valid'] == 0)
			{
				$_SESSION['pseudo'] = $data['name'];
	    		$_SESSION['rang'] = $data['rang'];
	   			$_SESSION['id'] = $data['id'];
	   	 		$message = '<p>Bienvenue '.$data['name'].', 
					vous êtes maintenant connecté!</p>
				<p>Cliquez <a href="index.php">ici</a> 
					pour revenir à la page d accueil</p>';
			}
			else
			{
	    		$message='<p>Votre compte n\'est pas activer, veuillez activer votre compte graçe au mail que vous avez reçu!<p>
				<p>Cliquez <a href="index.php">ici</a></p>';
			}  
		}
		else // Acces pas OK !
		{
	    	$message = '<p>Une erreur s\'est produite 
	    	pendant votre identification.<br /> Le pseudo ou le  mot de passe
           	entré n\'est pas correcte.</p><p>Cliquez <a href="index.php">ici</a></p>';
		}
		$query->CloseCursor();
	}
    echo $message;
}
$pdo = NULL;
?>