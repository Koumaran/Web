<?php
session_start();
if ($_POST["deconnexion"] == "logout")
{
  $_SESSION["loggued_on_user"] = NULL;
  $_SESSION["admin"] = NULL;
  session_destroy();
  header('Location: index.php');
}
else if ($_POST["modifier"] == "modifier mon compte")
{
  header('Location: user.php');
}
?>
