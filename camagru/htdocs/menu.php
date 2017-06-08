<ul id="menu" class="red">
	<?php 
		if ($_SESSION['logged_on_user'])
		{ ?>
	<li><a href="#" title="aller à la section Mon compte">Mon compte</li>
	<li><a href="#" title="aller à la section PhotoBoot">PhotoBoot</li>
	<li><a href="#" title="aller à la section Gallerie">Gallerie</li>
	<?php } ?>
</ul>