<?php
session_start();
include('../config/database.php');
include("../config/identification.php");
include("../config/preface.php");

header('content-Type: text/xml');

require '../function/ft_connect_db.php';

$query = $pdo->prepare('SELECT id_img, img, likes FROM Image ORDER BY id_img');
try {
    $query->execute();
}
catch(PDOExeption $e) {
    die("Erreur galerie: ".$e->getMessage());
}
echo json_encode($query->fetchAll());
$query->closeCursor();
