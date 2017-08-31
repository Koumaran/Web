<?php
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
	catch(PDOException $e){
		die('Erreur : '.$e->getMessage());
	}
}
?>