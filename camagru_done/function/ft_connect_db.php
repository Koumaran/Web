<?php
/****************** connexion à Mysql sans base de données ********/
try
{
	$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
        die('Erreur : ' . $e->getMessage());
}
$db = $pdo->prepare('USE '.DB_NAME);
try
{
	$db->execute();
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}
?>