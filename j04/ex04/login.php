<?PHP
session_start();
include "auth.php";

$login = $_POST['login'];
$passwd = $_POST['passwd'];
if ($login && $passwd)
{
	if (auth($login, $passwd))
	{
		$_SESSION['loggued_on_user'] = $login;
		echo '<iframe name="char" src="chat.php" style="width: 100%; height: 550px;"></iframe>';
		echo '<iframe name="speak" src="speak.php" style="width: 100%; height:50px;"></iframe>';
	}
	else
	{
		$_SESSION['loggued_on_user'] = "";
		echo "ERROR\n";
	}
}
else
{
	echo "ERROR\n";
	$_SESSION['loggued_on_user'] = "";
}
?>
