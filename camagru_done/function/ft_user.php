<?PHP
function get_user_name($log_id)
{
	if (file_exists('function/ft_connect_db.php'))
		require 'function/ft_connect_db.php';
	else
		require 'ft_connect_db.php';

	$query = $pdo->prepare('SELECT name FROM User WHERE id_user = :id');
	$query->bindValue(':id', $log_id, PDO::PARAM_INT);
	try {
		$query->execute();
	}
	catch(PDOExeption $e) {
		echo "ERROR get user name: ".$e->getMessage();
	}
	$restult = $query->fetch();
	$query->closeCursor();
	if (isset($restult['name']))
		return $restult['name'];
	return 0;
}

function get_user_mail($log_id)
{
	if (file_exists('function/ft_connect_db.php'))
		require 'function/ft_connect_db.php';
	else
		require 'ft_connect_db.php';

	$query = $pdo->prepare('SELECT mail FROM User WHERE id_user = :id');
	$query->bindValue(':id', $log_id, PDO::PARAM_INT);
	try {
		$query->execute();
	}
	catch(PDOExeption $e) {
		echo "ERROR get user name: ".$e->getMessage();
	}
	$restult = $query->fetch();
	$query->closeCursor();
	if (isset($restult['mail']))
		return $restult['mail'];
	return 0;
}

function get_notification($log_id) {
	if (file_exists('function/ft_connect_db.php'))
	require 'function/ft_connect_db.php';
else
	require 'ft_connect_db.php';

$query = $pdo->prepare('SELECT notification FROM User WHERE id_user = :id');
$query->bindValue(':id', $log_id, PDO::PARAM_INT);
try {
	$query->execute();
}
catch(PDOExeption $e) {
	echo "ERROR get user name: ".$e->getMessage();
}
$restult = $query->fetch();
$query->closeCursor();
if (isset($restult['notification']))
	return $restult['notification'];
return 0;
}
?>