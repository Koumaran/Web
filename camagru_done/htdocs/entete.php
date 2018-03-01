<header id="header">
	<p>Camagru</p>
	<div class="menu">
<ul>
	<?php 
		if ($id!=0)
		{
			echo '
			<li><a href="index.php?page=compte.php" title="gérer mon compte">Mon Compte</a></li>
			<li><a href="index.php?page=photobooth.php" title="aller à la section PhotoBooth">PhotoBooth</a></li>
			<li><a href="index.php" title="aller à la section Galerie">Galerie</a></li>
			<li><a href="index.php?deco=yes" title="deconnexion">Déconnexion</a></li>
			';
		} else {
			echo '
			<li><a href="index.php?page=connexion.php" title="Se Connecter">Se Connecter / S\'inscrire</a></li>
			<li><a href="index.php" title="aller à la section Galerie">Galerie</a></li>
			';
		} ?>
</ul>
</div>
</header>