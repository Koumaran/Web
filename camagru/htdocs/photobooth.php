<?php
include('function/error.php');
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

</div>
<script type="text/javascript" src="javascript/camera2.js"></script>
