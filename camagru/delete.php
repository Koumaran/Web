<?php
include('setup/database.php');
try
{
	$pdo = new PDO('mysql:host='.DB_HOST.';charset=utf8', DB_USER, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
        die('Erreur : ' . $e->getMessage());
}
$query = 'DROP DATABASE IF EXISTS '.DB_NAME;
try
{
	$pdo->exec($query);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}
echo 'db delete';
?>
