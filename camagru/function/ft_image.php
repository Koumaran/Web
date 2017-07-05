<?php
// Calcule le nombre total d'image dans la table images
function count_img_tab()
{
	require 'ft_connect_db.php';

	$query = $pdo->prepare('SELECT COUNT(id_img) AS nb_img FROM Image');
	$query->execute();
	$data = $query->fetch();
	$query->closeCursor();
	$nb_img = (isset($data['nb_img'])) ? $data['nb_img'] : 0;
	return ($nb_img);
}
//retourne un tableau d'image creer par l'utilisateur $login
function get_img_user($log_id)
{
	require 'ft_connect_db.php';

	$query = $pdo->prepare('SELECT img FROM Image WHERE id_user = :log_id ORDER BY date_img');
	$query->bindValue(':log_id', $log_id, PDO::PARAM_INT);
	$query->execute();
	$data = $query->fetchall();
	$query->closeCursor();
	return ($data);
}

function get_id_user_img($id_img)
{
	require 'ft_connect_db.php';

	$query = $pdo->prepare('SELECT id_user FROM Image WHERE id_img = :img');
	$query->bindValue(':img', $id_img, PDO::PARAM_INT);
	try {
		$query->execute();
	}
	catch(PDOExeption $e) {
		echo 'Error get_id_user_img :'.$e->getMessage();
	}
	$data = $query->fetch();
	$query->closeCursor();
	if (isset($data['id_user']))
		return $data['id_user'];
	return 0;
}
?>