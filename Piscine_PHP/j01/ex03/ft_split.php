<?php
function ft_split($s1)
{
$tmp = explode(" ", $s1);
sort($tmp);
$tab = array();
foreach ($tmp as $value)
{
	if (!empty($value))
		$tab[] = $value;
}
unset($tmp);
unset($value);
return ($tab);
}
?>
