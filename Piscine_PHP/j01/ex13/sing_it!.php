#!/usr/bin/php 
<?php
if ($argc == 2)
{
	if ($argv[1] == "mais pourquoi cette demo ?")
		echo "Tous simplement pour qu'en feuilletant le sujet\non ne s'apercoive pas de la nature de l'exo\n";
	else if ($argv[1] == "mais pourquoi cette chanson ?")
		echo "Parce aue Kwame a des enfants\n";
	else if ($argv[1] == "vraiment ?")
	{
		$num = rand(0, 1);
		if ($num == 0)
			echo "Nan c'est parce aue c'est le premier avril\n";
		else 
			echo "Oui il a vraiment des enfants\n";
	}
}
?>
