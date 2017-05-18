<?php

function change_pw($tab, $pass)
{
	$e = 0;
	$i = 0;
	foreach($tab as $login)
	{
		foreach($login as $key => $value)
		{
			if ($e == 1)
			{
				if ($value == $pass)
				{
					if ($_POST[submit] == "delete")
					{
						unset($tab[$i]);
						file_put_contents("../private/passwd",serialize($tab));
						session_start();
						$_SESSION["logged_on_user"] = NULL;
						session_destroy();
						return (3);
					}
					else
					{
						$tab[$i][passwd] = hash('whirlpool', $_POST[newpw]);
						file_put_contents("../private/passwd",serialize($tab));
						return (2);
					}
				}
			}
			if ($value == $_POST[login] && $i > 0)
			{
				if ($_POST[delete_user] == "Supprimer l'utilisateur")
				{
					unset($tab[$i]);
					file_put_contents("../private/passwd",serialize($tab));
					return (4);
				}
				else
					$e++;
			}
		}
		$i++;
	}
	if ($_SESSION[admin] = "admin") // checker parce y a pas == //
		return (5);
	return (0);
}
if ($_POST[modifier_user] == "Modifier l'utilisateur" && isset($_POST['login'])){
	header('Location: user.php'); // a faire modification!
}
if ($_POST[delete_user] == "Supprimer l'utilisateur" && isset($_POST[login]))
	$modif = "no";
else if ((!$_POST[login] || !$_POST[oldpw] || !$_POST[newpw] || !$_POST[submit]) && $_POST[submit] != "delete")
{
	$modif = "yes";
}
if ($_POST[login] != $_SESSION[login]) // nouveau
	header('Location: index.php');
if ($_POST[login] == "admin")
	header('Location: admin/admin.php'); // si temps mettre cant delete admin //
else if ($modif = "no") // il ya = au lieu de == bizarre
{
	$tab = unserialize(file_get_contents("../private/passwd"));
	$pass = hash('whirlpool', $_POST['oldpw']);
	$res = change_pw($tab, $pass);
	if ($res > 1 && $res < 4)
		header('Location: index.php'); // si temps mettre succes mot de passe changed //
	else if ($res == 4)
		header('Location: admin/admin.php'); // si temps mettre succes mot de passe changed //
	else if ($res == 5)
		header('Location: admin/manage_user.php');
	else
		header('Location: user.php'); // si temps mettre
}
?>
