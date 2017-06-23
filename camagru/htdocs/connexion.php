<?php
//on verifie si l'utilisateur n'est pas déja connecter
if ($id!=0) erreur('Vous ne pouvez pas accéder à cette page si vous êtes connecté');
?>
<div id="form_wrapper" class="form_wrapper" style="width: <?echo $form;?>">
<? if ($form === "360px") { ?>
<form class="register active" method="post" action="index.php?page=valid_connect.php">
	<h3>Inscription</h3>
	<div>
		<div>
			<label>Identifiant:*</label>
			<input type="text" name="identifiant"/>
		</div>
		<div>
			<label>Email:*</label>
			<input type="mail" name="mail"/>
		</div>
		<div>
			<label>Mot de pass:*</label>
			<input type="password" name="password"/>
		</div>
	</div>
	<div class="bottom">
		<input type="submit" name="register" value="Register" />
		<a href="index.php?page=connexion.php&form=350px" rel="login" class="linkform">
			Vous avez déja votre compte? connectez-vous
		</a>
		<div class="clear"></div>
	</div>
</form>
<? } else if ($form === "300px") { ?>
<!-- remind password form -->
<form class="forgot_password active" method="post" action="index.php?page=valid_connect.php">
	<h3>Mot de pass oublié</h3>
	<div>
		<label>Identifiant:</label>
		<input type="text" name="identifiant">
	</div>
	<div>
		<label>Email:</label>
		<input type="mail" name="mail"/>
	</div>
	<div class="bottom">
		<input type="submit" name="reminder" value="Envoyer"></input>
		<a href="index.php?page=connexion.php&form=350px" rel="login" class="linkform" >
			Ah tu n'a pas tous oublié? connecte toi ici!
		</a>
		<a href="index.php?page=connexion.php&form=360px" rel="register" class="linkform" >
			Pas de compte? enregistre toi!
		</a>
		<div class="clear"></div>
	</div>
</form>
<? } else { ?>
<!-- login form -->
<form class="login active" method="post" action="index.php?page=valid_connect.php">
	<h3>Connexion</h3>
	<div>
		<label>Indentifiant:</label>
		<input type="text" name="identifiant" />
	</div>
	<div>
		<label>Mot de pass: 
			<a href="index.php?page=connexion.php&form=300px" rel="forgot_password" class="forgot">
				Mot de pass oublié?
			</a>
		</label>
		<input type="password" name="password" />
	</div>
	<div class="bottom">
		<input type="submit" name="login" value="Login"></input>
		<a href="index.php?page=connexion.php&form=360px" rel="register" class="linkform" >
			Pas de compte? enregistre toi!
		</a>
		<div class="clear"></div>
	</div>
</form>
<? } ?>
</div>