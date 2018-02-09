<?
//retourne un boolean si un like correspont au login et au img
function get_like_img_user($log_id, $img_id)
{
	require 'ft_connect_db.php';

	$query = $pdo->prepare('SELECT id_likes FROM Likes WHERE id_user = :log_id AND id_img = :img_id');
	$query->bindValue(':log_id', $log_id, PDO::PARAM_INT);
	$query->bindValue(':img_id', $img_id, PDO::PARAM_INT);
	try {
    	$query->execute();
    }
    catch(PDOExecption $e) {
        echo "ERROR get_like_img_user : ".$e->getMessage();
	}
	$data = $query->fetch();
	$query->closeCursor();
	if (isset($data['id_likes']) && $data['id_likes'] != 0)
		return (true);
	return (false);
}

function add_like($log_id, $img_id)
{
	require 'ft_connect_db.php';
	//ajout du like dans table likes
	$query = $pdo->prepare('INSERT INTO Likes (id_user, id_img) VALUES (:log_id, :img_id);');
	$query->bindValue(':log_id', $log_id, PDO::PARAM_INT);
	$query->bindValue(':img_id', $img_id, PDO::PARAM_INT);
	try {
    	$query->execute();
    }
    catch(PDOExecption $e) {
        echo "ERROR ajout du like : ".$e->getMessage();
    }
    //ajout du like dans like de table image
    //likes = likes + 1 ne fonctionne uniquement si likes ne vaut pas null
    $query = $pdo->prepare('UPDATE Image SET likes = likes + 1 WHERE id_img = :img_id');
    $query->bindValue(':img_id', $img_id, PDO::PARAM_INT);
    try {
    	$query->execute();
    }
    catch(PDOExecption $e) {
    	echo "ERROR ajout du like : ".$e->getMessage();
    }

}

function remove_like($log_id, $img_id)
{
	require 'ft_connect_db.php';
	//supression du like
	$query = $pdo->prepare('DELETE FROM Likes WHERE id_user = :log_id AND id_img = :img_id');
	$query->bindValue(':log_id', $log_id, PDO::PARAM_INT);
	$query->bindValue(':img_id', $img_id, PDO::PARAM_INT);
	try {
    	$query->execute();
    }
    catch(PDOExecption $e) {
        echo "ERROR suppression du like : ".$e->getMessage();
    }
    //remet le compteur a partir du plus grand trouvé 
    $query = $pdo->prepare('ALTER TABLE Likes AUTO_INCREMENT = 0');
    try {
    	$query->execute();
    }
    catch(PDOExecption $e) {
        echo "ERROR suppression du like : ".$e->getMessage();
    }
    //supression  du like dans likes de table image
    $query = $pdo->prepare('UPDATE Image SET likes = likes - 1 WHERE id_img = :img_id');
    $query->bindValue(':img_id', $img_id, PDO::PARAM_INT);
    try {
    	$query->execute();
    }
    catch(PDOExecption $e) {
    	echo "ERROR suppression du like : ".$e->getMessage();
    }
}

function get_nb_like($img_id)
{
	require 'ft_connect_db.php';

	$query = $pdo->prepare('SELECT likes FROM Image WHERE id_img = :img_id');
	$query->bindValue(':img_id', $img_id, PDO::PARAM_INT);
	try {
		$query->execute();
	}
	catch(PDOExecption $e) {
		echo "ERROR get_nb_like: ".$e->getMessage();
	}
	$res = $query->fetch();
	$query->closeCursor();
	if (isset($res['likes']))
		return $res['likes'];
	return 0;
}
?>