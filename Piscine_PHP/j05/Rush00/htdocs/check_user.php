<?php

include_once 'login.php';
if (($_POST["register"] == "Se connecter") && (!$_POST["login"] || !$_POST["passwd"]))
		header('Location: index.php');
else
{
	if ($_POST["register"] == "Se connecter")
	{
		if (login($_POST[login], $_POST[passwd]) == 2)
			header('Location: admin/admin.php');
		else if (login($_POST[login], $_POST[passwd]) == 3)
			header('Location: index.php');
		else
		{
			$_SESSION['loggued_on_user']= "";
			header('Location: index.php');
		}
	}
	else if ($_POST["register"] == "S'inscrire")
		header('Location: register.php');
}
?>
