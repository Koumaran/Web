<?php
session_start();
include('../config/database.php');
include("../config/identification.php");
include("../config/preface.php");

header('content-Type: text/xml');
echo $id;
?>