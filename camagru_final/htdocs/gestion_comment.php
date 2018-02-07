<?php
session_start();
include('../config/database.php');
include("../config/identification.php");
include("../config/preface.php");
include("../function/ft_comment.php");
include("../function/ft_image.php");
include("../function/ft_user.php");

if (isset($_POST['img_id']) && isset($_POST['value']) && isset($_POST['state']))
{
	$img_id = $_POST['img_id'];
	$value = htmlspecialchars($_POST['value']);
	if ($_POST['state'] == 1)
	{
		if (($result = add_comment($id, $img_id, $value))!== 0) {
			$id_user_img = get_id_user_img($img_id);
			if ($id_user_img !== $id)
			{
				$user_name = get_user_name($id_user_img);
				$user_mail = get_user_mail($id_user_img);
				$entete = "From: jsivanes@student.42.fr";
				$message = 'Bonjour '.$user_name.'
				Vous avez reçu un nouveau commentaire sur votre photo numero '.$img_id.'.


				---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';
			}
			mail($user_mail, 'Nouveau commentaire', $message, $entete);
			echo $result.'|'.$pseudo;
		}
		else
			echo $result;
	}
}
else if (isset($_POST['id_comment']) && isset($_POST['state']))
{
	$comment_id = $_POST['id_comment'];
	if ($_POST['state'] == 2)
	{
		remove_comment($comment_id);
	}
	else
		echo "false sup";
}
else
	echo "false end";