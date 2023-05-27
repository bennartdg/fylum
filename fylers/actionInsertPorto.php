<?php
include ('../server/connection.php');

$fyler_id = $_GET['fyler_id'];
$path = "../assets/images/portos/" . basename($_FILES['porto_photo']['name']);
$porto_name = $_POST['porto_name'];
$porto_desc = $_POST['porto_desc'];
$old_date = $_POST['porto_date'];

$porto_date = date("Y-m-d", strtotime($old_date));
$porto_photo = $_FILES['porto_photo']['name'];

$q_porto = "INSERT INTO portos 
            VALUES (null, '$fyler_id', '$porto_name', 
            '$porto_desc', '$porto_date', '$porto_photo')
            ";
$r_porto = mysqli_query($conn, $q_porto);

if(move_uploaded_file($_FILES['porto_photo']['tmp_name'], $path)){
   if($r_porto == true){
       header('location: index.php?success=1&message=Your Porto has been uploaded');
    } else {
        header('location: index.php?success=0&error=Failed to upload');
    }
}
?>