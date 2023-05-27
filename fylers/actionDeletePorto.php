<?php
include ('../server/connection.php');

$porto_id = $_GET['porto_id'];
$porto_photo = $_GET['porto_photo'];

$q_porto = "DELETE FROM portos WHERE porto_id='$porto_id'";
$r_porto = mysqli_query($conn, $q_porto);

$path = "../assets/images/portos/" . $porto_photo;

if($r_porto){
    if(file_exists($path)){
        unlink($path);
        header('location: index.php?success=1&message=Your Porto has been deleted');
    } 
} else {
    header('location: index.php?success=0&error=Failed to deleted your porto');
}