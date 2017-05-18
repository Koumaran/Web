<?php

function get_passwd($path)
{
	return (unserialize(file_get_contents($path)));
}

function put_in_file($path, $passwd_tab)
{
	file_put_contents($path, serialize($passwd_tab));
	header("Location:index.html;");
	echo "OK\n";
}

if ($_POST['login'] != "" && $_POST['oldpw'] != "" && $_POST['newpw'] && $_POST['submit'] == "OK")
{
	$path = "../private/passwd";
	$passwd_tab = get_passwd($path);
	$oldpw = hash("whirlpool", $_POST['oldpw']);
	$newpw = hash("whirlpool", $_POST['newpw']);
	if ($passwd_tab !== false && $oldpw != $newpw)
	{
		foreach ($passwd_tab as $key => $value)
		{
			if ($value['login'] == $_POST['login'] && $value['passwd'] == $oldpw)
			{
				$passwd_tab[$key]['passwd'] = $newpw;
				$changed = TRUE;
			}
			$i++;
		}
		if ($changed === TRUE)
			put_in_file($path, $passwd_tab);
		else
			echo "ERROR\n";
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
