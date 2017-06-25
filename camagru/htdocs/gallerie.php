<?php
include('function/error.php');
$query = $pdo->prepare('SELECT COUNT(id_img) AS nb_img FROM image');
$query->execute();
$data = $query->fetch();
$query->closeCursor();
$nb_img = (isset($data['nb_img'])) ? $data['nb_img'] : 0;
$perPage = 6;
$nbPage = ceil($nb_img / $perPage);
$cPage = (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage) ? $_GET['p'] : 1;
if ($nb_img != 0)
{
	$query = $pdo->prepare('SELECT img, user_name, likes FROM image ORDER BY date_img LIMIT :cPage2, :perPage');
	$cPage2 = (($cPage - 1) * $perPage);
	$query->bindValue(':cPage2', $cPage2, PDO::PARAM_INT);
	$query->bindValue(':perPage', $perPage, PDO::PARAM_INT);
	$query->execute();
	while (($data = $query->fetch())) {?>
		<div class="col-4">
			<div class="booth">
				<div class="pic_gallerie">
					<img src="'.$data['img'].'">
				</div>
				<button id="like" class="heart">Like</button>
			</div>
			<div class="booth" style="border-top: 0;">
				<input type="text" maxlength="300" name="comment_text" class="comment_text" placeholder="Un commentaire?">
				<button id="comment_but" class="comment_but" >Envoyer</button>
				<div class="comment" id="comment">
				<?

				?>
				</div>
			</div>
		</div>
	<?}
	if ($nbPage > 1) {
		$i = 0;
		?><div class="pagination"><?
		while ($i++ < $nbPage)
		{
			if ($i == $cPage) {
				echo '<a href="index.php?page=gallerie.php&p='.$i.'" class="active">'.$i.'</a>';				
			} else {
				echo '<a href="index.php?page=gallerie.php&p='.$i.'">'.$i.'</a>';
			}

		}
		?></div><?
	}
}
else
{
	echo "<div class='col-12'><p style='text-align:center;'><bold>La gallerie est vide...</bold><p>";
}
?>
