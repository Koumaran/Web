<?php
session_start();
include('../setup/database.php');
include("../setup/identification.php");
include("../setup/preface.php");

header('content-Type: text/xml');
$path = '../images/'; 
$extension = 'png';
if (isset($_POST['photo']))
{
	$photo = $_POST['photo'];
	$query = $pdo->prepare('DELETE FROM Image WHERE img = :photo');
    try {
    	$query->execute(array(':photo' => $photo));
    }
    catch(PDOExecption $e) {
        echo "ERROR suppression de l'image : ".$e->getMessage();
    }
    if (file_exists('../'.$photo))
    {
        unlink('../'.$photo);
    }
    echo 'yes';
}
else {
    echo "no";
}