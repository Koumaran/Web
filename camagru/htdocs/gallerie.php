<?php
include('function/error.php');
include('function/ft_image.php');
include('function/ft_likes.php');
include('function/ft_comment.php');
include('function/ft_user.php');

$nb_img = count_img_tab();
$perPage = 6;
$nbPage = ceil($nb_img / $perPage);
$cPage = (isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage) ? $_GET['p'] : 1;
if ($nb_img != 0)
{
	$query = $pdo->prepare('SELECT id_img, img, likes FROM Image ORDER BY id_img DESC LIMIT :cPage2, :perPage');
	$cPage2 = (($cPage - 1) * $perPage);
	$query->bindValue(':cPage2', $cPage2, PDO::PARAM_INT);
	$query->bindValue(':perPage', $perPage, PDO::PARAM_INT);
	try {
		$query->execute();
	}
	catch(PDOExeption $e) {
		die("Erreur gallerie: ".$e->getMessage());
	}
	while (($data = $query->fetch()))
	{
		$likes = get_like_img_user($id, $data['id_img']);
		$likes = ($likes === true)? "like" : "not_like";
		?>
		<div class="col-4">
			<div id="up_gallerie" class="booth">
				<div class="pic_gallerie">
					<img src=<?echo $data['img'];?> style="width:100%;">
				</div>
				<input type='button' id=<?echo $data['id_img']?> class=<?echo $likes;?> onclick="get_like(this);" value=<?if ($likes === 'like') {echo $data['likes'];} else {echo'Like';}?>>
			</div>
			<div id="commentbox" class="commentbox" style="border-top: 0;">
				<input id=<?echo $data['id_img'];?> type="text" maxlength="300" name="comment_text" class="comment_text" placeholder="Un commentaire?" onKeyPress="if (event.keyCode == 13) add_comment(this);">
				<?
				$comments = get_comment_img($data['id_img']);
				foreach ($comments as $comment) {
					$user_name = get_user_name($comment['id_user']);
					echo "<div id='".$comment['id_comment']."'class='dialogbox'><span>".$user_name."</span><div class='message'><span>".$comment['message']."</span></div>";
					if ($user_name === $pseudo)
						echo "<button class='cross' onclick='sub_comment(this);'>X</button></div>";
					else
						echo "</div>";
				}
				?>
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
<script type="text/javascript" src="javascript/gallerie.js"></script>
