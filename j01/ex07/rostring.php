#!/usr/bin/php
<?php
if ($argc > 1)
{
	$str = trim($argv[1]);
	$str = str_replace("\t", " ", $str);
	$str = str_replace("\n", " ", $str);
	$str = str_replace("\r", " ", $str);
	$tab = explode(" ", $str);
	$ended_tab = array();
	foreach ($tab as $value)
	{
		if (!empty($value))
			$ended_tab[] = $value;
	}
	$str = $ended_tab[0];
	foreach ($ended_tab as $value)
	{
		if ($value != $str)
			print("$value ");
	}
	print("$str\n");
}
?>
