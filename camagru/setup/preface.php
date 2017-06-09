<?php
if (isset($_GET['deco']) && $_GET['deco'] === 'yes')
{
		session_destroy();
		header('Location: index.php');
}
$page=(isset($_GET['page']))?$_GET['page']:"connexion.php";
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';
$portrait=(isset($_SESSION['portrait']))?$_SESSION['portrait']:0;
$rang=(isset($_SESSION['rang']))?(int) $_SESSION['rang']:0;
?>