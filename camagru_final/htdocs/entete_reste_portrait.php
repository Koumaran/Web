<div id="log_point">
	<?php
	if ($id!=0)
	{
		if ($portrait!=0)
		{
			echo '<a href="index.php?page=compte.php"><img id="login_img" src=\''.$portrait.'\' alt="Longin" title="Se connecter"></a>';
		} 
		else
		{
			?><a href="index.php?page=compte.php"><img id="login_img" src="ressources/login2.png" alt="Longin" title="Se connecter"></a><?php
		}
	}
	else
	{ 
		?><a href="index.php"><img id="login_img" src="ressources/login2.png" alt="Longin" title="Se connecter"></a><?php
	}
	?>
	</div>