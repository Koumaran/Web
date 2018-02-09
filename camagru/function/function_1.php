<?php
function str_alnum($str) {
	$num = 0;
	$alpha = 0;
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++) {
		$alpha += ($str[$i] >= 'a' && $str[$i] <= 'z') ? 1 : 0;
		$alpha += ($str[$i] >= 'A' && $str[$i] <= 'Z') ? 1 : 0;
		$num += ($str[$i] >= '0' && $str[$i] <= '9') ? 1 : 0;
	}
	if ($alpha && $num)
		return true;
	return false;
}

function redirect($url, $message)
{
	if ($message === 0)
	{
		echo '<script language="JavaScript" type="text/javascript">
		window.setTimeout("location=(\''.$url.'\');",0000);
		</script>';
	} else {
    	echo $message;
    	echo '<script language="JavaScript" type="text/javascript">
		window.setTimeout("location=(\''.$url.'\');",3000);
		</script>';
	}
}
?>