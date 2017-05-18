<?php
function ft_is_sort($tab)
{
	$tab2 = $tab;
	sort($tab2);
	return ($tab2 == $tab);
}
?>
