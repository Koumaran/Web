<?php
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