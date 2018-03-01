<?PHP
function add_comment($log_id, $img_id, $value)
{
	require 'ft_connect_db.php';
	date_default_timezone_set('Europe/Paris');

	$this_date = date("YmdHis");
	$query = $pdo->prepare('INSERT INTO Comment (id_user, id_img, message, date_comment) VALUES (:log_id, :id_img, :value, :this_date)');
	try {
		$query->execute(array(':log_id' => $log_id, ':id_img' => $img_id, ':value' => $value, ':this_date' => $this_date));
	}
	catch(PDOExeption $e) {
		echo "ERROR ajout du comment: ".$e->getMessage();
		return 0;
	}
	$query = $pdo->prepare('SELECT id_comment FROM Comment WHERE date_comment = :this_date');
	$query->bindValue(':this_date', $this_date, PDO::PARAM_STR);
	try {
		$query->execute();
	}
	catch(PDOExeption $e) {
		echo "ERROR ajout du comment: ".$e->getMessage();
		return 0;
	}
	$data = $query->fetch();
	$query->closeCursor();
	if (isset($data['id_comment'])) {
		 return $data['id_comment'];
	}
	return 0;
}

function get_comment_img($img_id)
{
	require 'ft_connect_db.php';

	$query = $pdo->prepare("SELECT id_comment, id_user, message FROM Comment WHERE id_img = :img_id ORDER BY date_comment DESC");
	$query->bindValue(':img_id', $img_id, PDO::PARAM_INT);
	try {
		$query->execute();
	}
	catch(PDOExeption $e) {
		echo "ERROR get_comment_img: ".$e->getMessage();
	}
	$data = $query->fetchAll();
	$query->closeCursor();
	return $data;
}

function remove_comment($comment_id)
{
	require 'ft_connect_db.php';

	$query = $pdo->prepare("DELETE FROM Comment WHERE id_comment = :comment_id");
	$query->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
	try {
		$query->execute();
	}
	catch(PDOExeption $e) {
		echo "ERROR remove comment: ".$e->getMessage();
	}
}
?>