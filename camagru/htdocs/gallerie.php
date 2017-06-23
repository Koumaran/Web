<?php
include('function/error.php');
$query = $pdo->prepare('SELECT COUNT(id_img) AS nb_img FROM image');
$query->execute();
$data = $query->fetch();
$query->closeCursor();
$nb_img = (isset($data['nb_img'])) ? $data['nb_img'] : 0;
$perPage = 3;
$nbPage = ceil($nb_img / $perPage);
$cPage = (isset($_GET['p']) && $_get['p'] > 0 && $_get['p'] <= $nbPage) ? $_GET['p'] : 1;
if ($nb_img != 0)
{
	$query = $pdo->prepare('SELECT img, user_name FROM image ORDER BY date_img');
	$cPage2 = (($cPage - 1) * $perPage);
	$query->execute();
	//$query->execute(array(':cPage2' => $cPage2, ':perPage' => $perPage));
	$data = $query->fetch();
	print_r($data);
}
else
{
	echo "<div class='col-12'><p style='text-align:center;'><bold>La gallerie est vide...</bold><p>";
}
?>
