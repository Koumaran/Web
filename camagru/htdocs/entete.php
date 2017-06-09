<header class="red">
	<h1>Camagru</h1>
	<div id="log_point">
	<?php
	if ($id!=0)
	{
		if ($portrait!=0)
		{
			?><a href="index.php?page=mon_compte.php"><img id="login_img" src='<?echo$_SESSION["portrait"]; ?>' alt="Longin" title="Se connecter"></a><?php
		} 
		else
		{
			?><a href="index.php?page=mon_compte.php"><img id="login_img" src="ressources/login2.png" alt="Longin" title="Se connecter"></a><?php
		}
	}
	else
	{ 
		?><a href="index.php"><img id="login_img" src="ressources/login2.png" alt="Longin" title="Se connecter"></a><?php
	}
	?>
	</div>
</header>