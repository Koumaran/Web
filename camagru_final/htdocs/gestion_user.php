<?php
session_start();
include('../setup/database.php');
include("../setup/identification.php");
include("../setup/preface.php");

header('content-Type: text/xml');
echo $id;
?>