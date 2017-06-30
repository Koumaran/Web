<?PHP
function get_user_name($log_id)
{
	require 'function/ft_connect_db.php';

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
?>