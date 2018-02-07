<?php
include('function/error.php');
include('function/ft_image.php');
if ($id == 0) erreur("Vous ne pouvez pas accéder à cette page si vous n\'êtes pas connecté");
?>
<div id='montage_box' class="col-12">
	<p style="margin: 0;">Etape 1: Choisissez une image de montage</p>
	<ul>
<?
if (false === ($montages = opendir("ressources/montages"))) {
	die ("ficher montage manquant!");
}
while (false !== ($montage = readdir($montages))) { 
	if ($montage != '.' && $montage != '..') {
		echo "<li>
				<img = id='montages' onclick='add_montage(this)' src='ressources/montages/".$montage."' title='".$montage."'>
		  	</li>";
	}
}
?>
	</ul>
</div>
<div class="col-12">
	<p>Etape 2: Prenez votre photo</p>
</div>
<div class="col-12">
	<div id="photo_booth">
		<video id="video"></video>
	</div>
</div>
<div id='button_box' class="col-12">
	<input type='button' id='filtre' value="Filtre" class="capture_button">
	<input type='button' id="capture" class="capture_button" value="Prendre une photo">
	<input type='button' id="save_button" class="save_button" value="Enregistrer">
</div>
<div class="col-12">
	<p>Etape 3: Visualisez votre photo</p>
</div>
<div class="col-12">
	<canvas id="canvas"></canvas>
	<img id="photo">
</div>
<?
	$tab_img = get_img_user($id);
	$len = count($tab_img);
	if ($len > 0) {
		echo "<div id='galerie' class='col-12 scrool'>";
		while ($tab_img[--$len]['img'])
		{
			echo "<div class='col-s vignette'>
				<img id='cross_img' width='100%' src='".$tab_img[$len]['img']."'>
				<button id='".$tab_img[$len]['img']."' class='cross' onclick='sub_img(this);'>X</button>
			</div>";
		}
		echo "</div>";
	}
?>
<script type="text/javascript" src="javascript/camera.js"></script>