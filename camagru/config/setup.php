<?php
session_start();
include('database.php');
try
{
	$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
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
if (file_exists('../images'))
{
	$files = array_diff(scandir('../images'), array('.', '..'));
	foreach ($files as $file) {
		unlink('../images/'.$file);
	}
	rmdir('../images');
}
if (isset($_SESSION['connected']) && $_SESSION['connected'] == 1) {
	session_destroy();
}
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = substr($actual_link, 0, strlen($actual_link) - 16);
$actual_link .= "index.php";
header('Refresh:2;url='.$actual_link);
echo "New project Camagru";
?>
