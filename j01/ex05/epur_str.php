#!/usr/bin/php
<?php
if ($argc == 2)
{
	$str = str_replace("\t", " ", $argv[1]);
	$str = str_replace("\n", " ", $str);
	$str = str_replace("\r", " ", $str);
	$str = trim($str);
	$tab = explode(" ", $str);
	$tab2 = array();
	foreach ($tab as $value)
	{
		if (!empty($value))
			$tab2[] = $value;
	}
	$str = implode(" ", $tab2);
	print("$str\n");
	unset($value, $tab, $str, $tab2);
}
?>
