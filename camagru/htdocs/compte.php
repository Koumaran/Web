<?php
include('function/error.php');
include('function/function_1.php');
if ($id==0) erreur('Vous ne pouvez pas accéder à cette page si vous n\'êtes pas connecté');
$query = $pdo->prepare("SELECT name, mail, password FROM User WHERE name = :login");
$query->execute(array(':login' => $pseudo));
$data = $query->fetch();
$query->closeCursor();
//portrait a faire
if ($portrait != 0)
{
	echo '<img id="portrait" src="'.$portrait.'">';
}
if (!isset($_POST['modifer']) && !isset($_POST['change_pass']))
{?>
<div class="col-6">
<div class="form_wrapper" style="width: 360px;">
	<form class="register active" method="post" action="index.php?page=compte.php">
		<h3>Mon Compte</h3>
		<div>
			<div>
				<label>Login :</label><input type="text" name="login" value=<?echo'"'.$pseudo.'"'?> />
			</div>
			<div>
				<label>E-Mail :</label><input type="mail" name="mail" value=<?echo'"'.$data['mail'].'"'?> />
			</div>
		</div>
		<div class="bottom">
			<input type='submit' name='modifer' value='Modifier' />
			<div class="clear"></div>
		</div>
	</form>
</div>
</div>
<div class="col-6">
<div class="form_wrapper" style="width: 360px;" >
	<form class="register active" method="post" action="index.php?page=compte.php">
		<h3>Mot de pass</h3>
		<div>
			<div>
				<label>Ancien mot de pass :</label><input type='password' name='old_pass' />
			</div>
			<div>
				<label>Nouveau mot de pass :</label><input type="password" name="new_pass" />
			</div>
			<div>
				<label>Confirmer le mot de pass :</label><input type="password" name="confirm_pass" />
			</div>
		</div>
		<div class="bottom">
			<input type="submit" name="change_pass" value="Modifier Mot de pass" />
			<div class="clear"></div>
		</div>
	</form>
</div>
</div>
<?}
else if (isset($_POST['modifer']) && !empty($_POST['login']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
		if ($_POST['login'] != $data['name'] || $_POST['mail'] != $data['mail']) {
		$query = $pdo->prepare('UPDATE User SET name = :new_login, mail = :mail WHERE id_user = :id');
		$query->execute(array(':new_login' => $_POST['login'], ':mail' => $_POST['mail'], ':id' => $id));
		$_SESSION['pseudo'] = $_POST['login'];
		redirect("index.php?page=compte.php", "votre modification est envoyer!");
		}
		else {
			redirect("index.php?page=compte.php", 0);
		}
} else if (isset($_POST['change_pass']) && !empty($_POST['old_pass']) && !empty($_POST['new_pass']) && !empty($_POST['confirm_pass'])) {
	$old_pass = hash('whirlpool', $_POST['old_pass']);
	if ($_POST['old_pass'] === $_POST['new_pass']) {
		redirect("index.php?page=compte.php", 0);
	}
	else if ($old_pass != $data['password']) {
		redirect("index.php?page=compte.php", "votre ancien mot de pass est incorrecte!");
	}
	else if ($_POST['new_pass'] != $_POST['confirm_pass']) {
		redirect("index.php?page=compte.php", "veuillez confirmer correctement votre nouveau mot de pass! ");
	} else {
		$new_pass = hash('whirlpool', $_POST['new_pass']);
		$query = $pdo->prepare('UPDATE user SET password = :pass WHERE id_user = :id;');
		$query->execute(array(':pass' => $new_pass, ':id' => $id));
		redirect("index.php?page=compte.php", "votre modification est envoyer!");
	}
}
else {
		redirect("index.php?page=compte.php", "Veuillez remplir correctement les champs requis au modification!");
}
?>
</div>
