<?PHP
function auth($login, $passwd)
{
	if ($login && $passwd)
	{
		$file = unserialize(file_get_contents("../private/passwd"));
		$mdp = hash("whirlpool", $passwd);
		foreach ($file as $key => $value)
		{
			if ($value['login'] == $login && $value['passwd'] == $mdp)
				return (TRUE);
		}
	}
	return (FALSE);
}
?>
