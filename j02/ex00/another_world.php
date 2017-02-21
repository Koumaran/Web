#!/usr/bin/php
<?php
if ($argc > 1)
{
	$regex = preg_replace('/[ \t]{1,}/', ' ', trim($argv[1]));
	print("$regex\n");
}
?>
