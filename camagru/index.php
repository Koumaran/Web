<?php
session_start();
include('setup/database.php');
/****************** connexion à Mysql sans base de données ********/
try
{
	$pdo = new PDO('mysql:host='.DB_HOST.';charset=utf8', DB_USER, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
        die('Erreur : ' . $e->getMessage());
}

$db = $pdo->prepare('SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?');
$db->execute(array(DB_NAME));
if ($db->fetchColumn() == 0) {
    include('setup/install.php');
} else {
	$db = $pdo->prepare('USE '.DB_NAME);
	try
	{
		$db->execute();
	}
	catch(PDOException $e)
	{
		die('Erreur : '.$e->getMessage());
	}
}
?>
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<HEAD>
	<META charset="UTF-8">
	<TITLE>Camagru</TITLE>
	<LINK rel="stylesheet" media="screen" type="text/css" title="style" href="css/main_style.css">
	</HEAD>
	<BODY>
		<?php include("htdocs/header.php"); ?>
		<?php include("htdocs/menu.php"); ?>
		<DIV classe="body">
			<form action=""
		</DIV>
		<?php include("htdocs/footer.php"); ?>
	</BODY>
</HTML>
