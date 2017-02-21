#!/usr/bin/php
<?php
if ($argc == 4)
{
	$num1 = trim($argv[1]);
	$op = trim($argv[2]);
	$num2 = trim($argv[3]);
	if ($op == "+")
		$resultat = $num1 + $num2;
	else if ($op == "-")
		$resultat = $num1 - $num2;
	else if ($op == "*")
		$resultat = $num1 * $num2;
	else if ($op == "/"  && $num2 != 0)
		$resultat = $num1 / $num2;
	else if ($op == "%"  && $num2 != 0)
		$resultat = $num1 % $num2;
	if ($op != "/" && $op != "%")
		print("$resultat\n");
	else if ($num2 != 0)
		print("$resultat\n");
}
else
	echo "Incorrect Parameters\n";
?>
