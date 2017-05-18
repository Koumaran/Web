<?php

function unser($path)
{
	return (file_exists($path) ? unserialize(file_get_contents($path)) : false);
}

?>
