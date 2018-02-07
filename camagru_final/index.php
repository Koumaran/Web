<?php
session_start();
include('config/database.php');
include("config/identification.php");
include("config/preface.php");
include("function/verif_function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<HEAD>
	<META name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
	<TITLE>Camagru</TITLE>
	<LINK rel="stylesheet" href="css/main.css">
	<LINK rel="stylesheet" href="css/connexion.css">
	<script>
		// Ce scripte change le nom de l'URL après le chargement de la page.
		function update_url(url) {
			history.pushState(null, null, url);
		}
	</script>
	</HEAD>
	<BODY>
		<?php include("htdocs/entete.php"); ?>
		<div id='container'>
		<?php
		if (!$_SESSION['URL'] || !$_SESSION['SITE_NAME']) {
			$_SESSION['URL'] = mystr_split("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], '?', 0);
			$tab = explode('/', $_SESSION['URL']);
			$_SESSION['SITE_NAME'] = $tab[3];
		} else {
			echo '<script> window.onload = update_url("Camagru");</script>';
		}		
		if ($id != 0)
		{
			if ($page === "compte.php") {
				include("htdocs/compte.php");
			}
			else if ($page === "photobooth.php") {
				include("htdocs/photobooth.php");
			}
			else if ($page === "galerie.php") {
				include('htdocs/galerie.php');
			}
		}
		elseif ($page === "valid_connect.php")
			include("htdocs/valid_connect.php");
		else
			include("htdocs/connexion.php");
		?>
		</div>
		<?php include("htdocs/footer.php"); ?>

	</BODY>
</HTML>
