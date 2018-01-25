<?php
session_start();
include('config/database.php');
include("config/identification.php");
include("config/preface.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<HEAD>
	<META name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
	<TITLE>Camagru</TITLE>
	<LINK rel="stylesheet" href="css/main.css">
	<LINK rel="stylesheet" href="css/connexion.css">
	</HEAD>
	<BODY onload="update_url('/Camagru/')">
		<?php include("htdocs/entete.php"); ?>
		<div id='container'>
		<?php
		if ($id != 0)
		{
			if ($page === "compte.php") {
				include("htdocs/compte.php");
			}
			else if ($page === "photobooth.php") {
				include("htdocs/photobooth.php");
			}
			else if ($page === "gallerie.php") {
				include('htdocs/gallerie.php');
			}
		}
		elseif ($page === "valid_connect.php")
			include("htdocs/valid_connect.php");
		else
			include("htdocs/connexion.php");
		?>
		</div>
		<?php include("htdocs/footer.php"); ?>

	<script>
		function update_url(url) {
			history.pushState(null, null, url);
		}
	</script>

	</BODY>
</HTML>
