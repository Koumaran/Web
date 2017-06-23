<?php 
session_start();
include('../setup/database.php');
include("../setup/identification.php");
include("../setup/preface.php");

header('content-Type: text/xml');
$path = '../images/'; 
$extension = 'png'; 
if (isset($_POST['data']))
{
    $this_date = date("YmdHis");
    $photo = $_POST['data'];
    $photo = str_replace('data:image/png;base64,', '', $photo);
    $photo = base64_decode($photo);

    $photo_name = "img_".$this_date.".".$extension;
    if (!file_exists($path)) {
        mkdir($path);
    }
    file_put_contents($path.$photo_name, $photo);    
    
    $query = $pdo->prepare('INSERT INTO image (img, id_user, date_img) VALUES (:img, :id, :date_img)');
    try {
    $query->execute(array(':img' => $photo_name, ':id' => $id, ':date_img' => $this_date));
    }
    catch(PDOExecption $e) {
        echo "ERROR ajout de l'image : ".$e->getMessage();
    }
    echo $photo_name;
}
else
    echo "false";
/*
    session_start(); 
    $path = 'images/'; 
    $extension = 'png'; 
     
    if(isset($_POST['img_data'])){ 
        $data = $_POST['img_data']; 
        $data = str_replace('data:image/png;base64,', '', $data); 
        $data = base64_decode($data); 

        $date = date('YmdHis'); 
        $file_name = "img_".$date.".".$extension; 
         
        file_put_contents($path.$file_name, $data); 
        $_SESSION['save_to_file'] = $file_name; 

        header('Content-type: image/png'); 
        $data = file_get_contents($path.$_SESSION['save_to_file']); 
            
        echo $data; 
         
    } else { 
        header('Content-type: image/png'); 
        header('Content-Disposition: attachment; filename="'.$_SESSION['save_to_file'].'"'); 

        $data = file_get_contents($path.$_SESSION['save_to_file']); 

        echo $data; 
    }
    */ 
?>