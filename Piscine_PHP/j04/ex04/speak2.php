<?PHP
session_start();
if ($_SESSION['logged_on_user'] != "" && $_POST['submit'] == "SEND")
{
?>
<html><head>
	<meta charset="UTF-8">
	<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>
</head>
<body>
<div id='chatbody'>
<?PHP
	if (file_exists("../private/chat") === FALSE)
	{
		$tab = array(array('time' => time(), 'login' => $_SESSION['logged_on_user'], 'msg' => $_POST['msg']));
		file_put_contents("../private/chat", serialize($tab));
	}
	else
	{
		$fd = fopen("../private/chat", "c+");
		flock($fd, LOCK_EX | LOCK_SH);
		$file = file_get_contents("../private/chat");
		$tab = unserialize($file);
		$tab[] = array('time' => time(), 'login' => $_SESSION['logged_on_user'], 'msg' => $_POST['msg']);
		file_put_contents("../private/chat", serialize($tab));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
?>
</div>
</body>
</html>
<?PHP
}
else
	echo "ERROR\n";
?>
