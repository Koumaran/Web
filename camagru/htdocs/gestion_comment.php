<?php
session_start();
include('../setup/database.php');
include("../setup/identification.php");
include("../setup/preface.php");
include("../function/ft_comment.php");

if (isset($_POST['img_id']) && isset($_POST['value']) && isset($_POST['state']))
{
	$img_id = $_POST['img_id'];
	$value = $_POST['value'];
	if ($_POST['state'] == 1)
	{
		if (($result = add_comment($id, $img_id, $value))!== 0) {
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