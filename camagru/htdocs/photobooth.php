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
<div class="col-6 col-p">
	<p>Etape 2: Prenez votre photo</p>
</div>
<div class="col-6 col-p">
	<p>Etape 3: Visualisez votre photo</p>
</div>
<div id="photo_booth" class="col-3 col-p">
		<video id="video"></video>
</div>
<div id='button_box' class="col-1">
	<a href="#" id='filtre' class="capture_button">Filtre</a>
	<a href="#" id="capture" class="capture_button">Prendre une photo</a>
	<a href="#" id="save_button" class="save_button">Enregistrer</a>
</div>
<div id="show_picture" class="col-3 col-p">
	<canvas id="canvas"></canvas>
	<img id="photo">
</div>
<?
	$tab_img = get_img_user($id);
	$len = count($tab_img);
	if ($len > 0) {
		echo "<div id='gallerie' class='col-11 scrool'>";
		while ($tab_img[--$len]['img'])
		{
			echo "<div class='col-s vignette'>
				<img id='cross_img' width='100%' src='".$tab_img[$len]['img']."'>
				<button id='".$tab_img[$len]['img']."' class='cross' onclick='sub_img(this);'>X</button>
			</div>";
		}
	}
?>
</div>
<script type="text/javascript" src="javascript/camera.js"></script>