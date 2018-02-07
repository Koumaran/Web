<?php
session_start();
include('../config/database.php');
include("../config/identification.php");
include("../config/preface.php");
include("../function/ft_likes.php");

header('content-Type: text/xml');
if (isset($_POST['img']))
{
	$img = $_POST['img'];
	$like = get_like_img_user($id, $img);
	if ($like === false) {
		add_like($id, $img);
		echo (get_nb_like($img));
	} else {
		remove_like($id, $img);
		echo 'true';
	}
} else
	echo 'false';
?>