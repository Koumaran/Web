#!/usr/bin/php
<?php

date_default_timezone_set('Europe/Paris');

function get_nb_mois($str)
{
	$mois = false;
	if (preg_match("/^[J|j]anvier$/", $str))
		$mois = 1;
	if (preg_match("/^[F|f]evrier$/", $str))
		$mois = 2;
	if (preg_match("/^[M|m]ars$/", $str))
		$mois = 3;
	if (preg_match("/^[A|a]vril$/", $str))
		$mois = 4;
	if (preg_match("/^[M|m]ai$/", $str))
		$mois = 5;
	if (preg_match("/^[J|j]uin$/", $str))
		$mois = 6;
	if (preg_match("/^[J|j]uillet$/", $str))
		$mois = 7;
	if (preg_match("/^[A|a]out$/", $str))
		$mois = 8;
	if (preg_match("/^[S|s]eptembre$/", $str))
		$mois = 9;
	if (preg_match("/^[O|o]ctobre$/", $str))
		$mois = 10;
	if (preg_match("/^[N|n]ovembre$/", $str))
		$mois = 11;
	if (preg_match("/^[D|d]ecembre$/", $str))
		$mois = 12;
	return ($mois);
}

if ($argc > 1)
{
	$tab = explode(" ", $argv[1]);
	if (count($tab) == 5 && preg_match_all("/:/", $argv[1]) == 2)
	{
		if (!preg_match("/^[lL]undi$|^[Mm]ardi$|^[Mm]ercredi$|^[Jj]eudi$|^[Vv]endredi$|^[Ss]amedi$|^[Dd]imanche$/", $tab[0]) || !preg_match("/^[0-9]{1,2}$/", $tab[1], $jour) || !preg_match("/^([a-z]|[A-Z]){3,9}$/", $tab[2], $mois) || !preg_match("/^[0-9]{4}$/", $tab[3], $anne) || !preg_match_all("/[0-9]{2}/", $tab[4], $heure))
			print("Wrong Format\n");
		else if (count($heure[0]) != 3 || ($nb_mois = get_nb_mois($mois[0])) === false)
			print("Wrong Format\n");
		else 
		{
			$res = mktime($heure[0][0], $heure[0][1], $heure[0][2], $nb_mois, $jour[0], $anne[0]);
			print("$res\n");
		}
	}
	else
		print("Wrong Format\n");
}
?>
