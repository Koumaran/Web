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
?>