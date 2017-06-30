<?php
include('function/error.php');
include('function/ft_image.php');
if ($id == 0) erreur("Vous ne pouvez pas accéder à cette page si vous n\'êtes pas connecté");
?>
<div id="photo_booth" class="col-4 booth">
	<video id="video" class="pictured"></video>
	<a href="#" id="capture" class="capture_button">Prendre une photo</a>
	<canvas id="canvas" class="pictured"></canvas>
	<img id="photo" class="pictured" width="100%" height="100%">
	<a href="#" id='filtre' class="capture_button">Filtre</a>
	<a href="#" id="save_button" class="save_button">Enregistrer</a>
</div>
<div class="col-2 booth">

</div>
<div id='gallerie' class='col-6 booth'>
<?
	$tab_img = get_img_user($id);
	$len = count($tab_img);
	while ($tab_img[--$len]['img'])
	{
		echo "<div class='col-6 vignette'>
			<img id='cross_img' width='100%' src='".$tab_img[$len]['img']."'>
			<button id='".$tab_img[$len]['img']."' class='cross' onclick='sub_img(this);'>X</button>
		</div>";
	}
?>
</div>
<script type="text/javascript" src="javascript/camera.js"></script>
