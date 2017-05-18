<?php

function get_passwd($path)
{
	return (file_exists($path) ? unserialize(file_get_contents($path)) : false);
}

function put_in_file($path, $passwd_tab)
{
	file_put_contents($path, serialize($passwd_tab));
	header('Location:index.html');
	echo "OK\n";
}

if ($_POST['login'] != "" && $_POST['passwd'] != "" && $_POST['submit'] == "OK")
{
	if (!file_exists("../private"))
		mkdir("../private");
	$path = "../private/passwd";
	$passwd_tab = get_passwd($path);
	if ($passwd_tab !== false)
	{
		$existe = false;
		foreach ($passwd_tab as $elem)
			if ($elem['login'] == $_POST['login'])
				$existe = true;
		if ($existe === false)
		{
			$passwd_tab[] = array('login' => $_POST['login'], 'passwd' => hash('whirlpool', $_POST['passwd']));
			put_in_file($path, $passwd_tab);
		}
		else
			echo "ERROR\n";
	}
	else
	{
		$passwd_tab = array();
		$passwd_tab[] = array('login' => $_POST['login'], 'passwd' => hash('whirlpool', $_POST['passwd']));
		put_in_file($path, $passwd_tab);
	}
}
else
	echo "ERROR\n";
?>
