<?php
include('function/verif_function.php');
if (empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['mail']))
{
	echo '<p>une erreur s\'est produite pendant votre enregistrement.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="index.php">ici</a> pour revenir</p>';
}
else if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
{
	$query = $pdo->prepare('SELECT id, name FROM user WHERE name = :pseudo');
	$query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
	$query->execute();
	$data = $query->fetch();
	$query->CloseCursor();
	if ($data['name'] === $_POST['pseudo'])
	{
		echo '<p>Ce pseudo n\'est pas disponible. Veuillez choisir un autre Pseudo.</p>
		<p>Cliquez <a href="index.php">ici</a></p>';
	}
	else
	{
		$pass =hash('whirlpool', $_POST['password']);
		$key = md5(microtime(TRUE)*100000);
		$query = sprintf("INSERT INTO user (name, password, mail, rang, cle, valid) 
			VALUES ('%s', '%s', '%s', '0', '%s', '0')", $_POST['pseudo'], $pass, $_POST['mail'], $key);
		try
		{
			$pdo->exec($query);
		}
		catch(PDOExecption $e)
		{
			echo ("Erreur ajout de ".$_POST['pseudo']." : ".$e->getMessage());
		}
		send_verif_mail($key);
		echo '<p>Bravo! Votre compte a était créé. Pensez a l\'activer avant de vous connecetez.</p>
		<p>Cliquez <a href="index.php">ici</a></p>';
	}
}
else
{
	echo '<p>Veuillez saisir une adresse email valide.</p>
	<p>Cliquez <a href="index.php">ici</a></p>';
}
$pdo = NULL;
?>