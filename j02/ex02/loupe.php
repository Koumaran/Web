#!/usr/bin/php
<?php

function str_upper($tab, $src)
{
	$i = 0;
	$len = count($tab);
	while ($i < $len)
	{
		if (preg_match($src, $tab[$i++]))
			$tab[$i] = strtoupper($tab[$i]);
	}
	return ($tab);
}

function link_upper2($tab, $i, $len)
{
	$i++;
	while (!preg_match("/\/a$/", $tab[$i]) && $i < $len)
	{
		$tab2 = explode("<", $tab[$i]);
		$tab2[0] = strtoupper($tab2[0]);
		$tab[$i] = implode("<", $tab2);
		$i++;
	}
	return ($tab);
}

function link_upper($tab, $src)
{
	$i = 0;
	$len = count($tab);
	while ($i < $len)
	{
		if (preg_match($src, $tab[$i++]))
		{
			$tab2 = explode("<", $tab[$i]);
			$tab2[0] = strtoupper($tab2[0]);
			$tab[$i] = implode("<", $tab2);
			if (!preg_match("/\/a$/", $tab[$i]))
				$tab = link_upper2($tab, $i, $len);
		}
	}
	return ($tab);
}

if ($argc > 1)
{
	$file = file_get_contents($argv[1]);
	$title = explode("\"", $file);
	$title = str_upper($title, "/title=/");
	$file = implode("\"", $title);
	$link = explode(">", $file);
	$link = link_upper($link, "/href=/");
	$file = implode(">", $link);
	print("$file");
}

?>
