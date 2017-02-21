#!/usr/bin/php
<?php
if ($argc > 1)
{
	$ended_tab= array();
	foreach ($argv as $elem)
	{
		if ($elem != $argv[0])
		{
			$elem = trim($elem);
			$elem = str_replace("\t", " ", $elem);
			$elem = str_replace("\n", " ", $elem);
			$elem = str_replace("\r", " ", $elem);
			$tab = explode(" ", $elem);
			foreach ($tab as $value)
			{
				if (!empty($value))
					$ended_tab[] = $value;
			}
		}
	}
	unset($elem, $value, $tab);
	sort($ended_tab);
	foreach ($ended_tab as $value)
		print("$value\n");
}
?>
