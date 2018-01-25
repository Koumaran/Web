<?php
session_start();
include('config/database.php');
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
if (file_exists('images'))
{
	$files = array_diff(scandir('images'), array('.', '..'));
	foreach ($files as $file) {
		unlink('images/'.$file);
	}
	rmdir('images');
}
if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
	session_destroy();
}
header('Refresh:3;url=index.php');
echo 'db delete';
?>
