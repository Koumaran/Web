<?php
if (isset($_GET['deco']) && $_GET['deco'] === 'yes')
{
		session_destroy();
		header('Location: index.php');
}

$form=(isset($_GET['form']))?$_GET['form']:"350px";
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
if ($id!=0)
	$page=(isset($_GET['page']))?$_GET['page']:"photobooth.php";
else
	$page=(isset($_GET['page']))?$_GET['page']:"connexion.php";
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$portrait=(isset($_SESSION['portrait']))?$_SESSION['portrait']:0;
$rang=(isset($_SESSION['rang']))?(int) $_SESSION['rang']:0;
?>