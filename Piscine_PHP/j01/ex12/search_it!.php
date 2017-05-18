#!/usr/bin/php
<?php
if ($argc > 2)
{
	$key = $argv[1];
	$i = 2;
	$result = false;
	while ($i < $argc)
	{
		$tab = explode(":", $argv[$i++]);
		if ($tab[0] == $key)
			$result = $tab[1];
	}
	if ($result != false)
		print("$result\n");
}
?>
