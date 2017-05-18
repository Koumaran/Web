<?PHP
session_start();

if (!$_SESSION['loggued_on_user'])
	echo "ERROR\n";
else
{
	$id = $_SESSION['loggued_on_user'];
	print("$id\n");
}
?>
