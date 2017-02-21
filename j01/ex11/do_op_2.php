#!/usr/bin/php
<?php
function do_op($op, $num1, $num2)
{
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
function pre_do($str, $pos)
{
	$nb1 = substr($str, 0, $pos);
	$op = substr($str, $pos, 1);
	$nb2 = substr($str, $pos + 1);
	$op = trim($op);
	$nb1 = trim($nb1);
	$nb2 = trim($nb2);
	if (!is_numeric($nb1) || !is_numeric($nb2))
		return (false);
	return (do_op($op, $nb1, $nb2));

}

if ($argc == 2)
{
	$pos = strpos($argv[1], "+");
	if ($pos === false)
		$pos = strpos($argv[1], "-");
	if ($pos === false)
		$pos = strpos($argv[1], "*");
	if ($pos === false)
		$pos = strpos($argv[1], "/");
	if ($pos === false)
		$pos = strpos($argv[1], "%");
	if ($pos === false || $pos < 1)
		print("Syntax Error\n");
	else
		$res = pre_do($argv[1], $pos);
	if ($res === false)
		print("Syntax Error\n");
}
else
	print("Incorrect Parameters\n");
?>
