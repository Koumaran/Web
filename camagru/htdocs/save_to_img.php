<?php
session_start();
include('../setup/database.php');
include("../setup/identification.php");
include("../setup/preface.php");
date_default_timezone_set('Europe/Paris');

header('content-Type: text/xml');
$path = '../images/'; 
$extension = 'png'; 
if (isset($_POST['data']))
{
    $this_date = date("YmdHis");
    $photo = $_POST['data'];
    $photo = str_replace('data:image/png;base64,', '', $photo);
    $photo = str_replace(' ', '+', $photo);
    $photo = base64_decode($photo);

    $photo_name = "img_".$this_date.".".$extension;
    if (!file_exists($path)) {
        mkdir($path);
    }
    file_put_contents($path.$photo_name, $photo);    
    
    $query = $pdo->prepare('INSERT INTO Image (img, id_user, likes, date_img) VALUES (:img, :log_id, 0, :date_img)');
    try {
    $query->execute(array(':img' => 'images/'.$photo_name, ':log_id' => $id, ':date_img' => $this_date));
    }
    catch(PDOExecption $e) {
        echo "ERROR ajout de l'image : ".$e->getMessage();
    }
    echo $photo_name;
}
else
    echo "false";
?>