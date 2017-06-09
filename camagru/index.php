<?php
session_start();
include('setup/database.php');
include("setup/identification.php");
include("setup/preface.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<HEAD>
	<META charset="UTF-8">
	<TITLE>Camagru</TITLE>
	<LINK rel="stylesheet" href="css/main_style.css">
	<LINK rel="stylesheet" href="css/inside_body.css">
	</HEAD>
	<BODY>
		<?php include("htdocs/entete.php"); ?>
		<?php include("htdocs/menu.php"); ?>
		<?php
		if ($id != 0)
		{
			if ($page === "compte.php") {
				include("htdocs/mon_compte.php");
			}
		}
		elseif ($page === "register.php")
			include("htdocs/register.php");
		else
			include("htdocs/connexion.php");
		?>
		<?php include("htdocs/footer.php"); ?>
	</BODY>
</HTML>
