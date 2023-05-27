<?php

use function PHPSTORM_META\map;

include('../server/connection.php');

$porto_id = $_GET['porto_id'];
$old_photo = $_GET['porto_photo'];
$old_path = "../assets/images/portos/" . $old_photo;

$path = "../assets/images/portos/" . basename($_FILES['porto_photo']['name']);
$porto_name = $_POST['porto_name'];
$porto_desc = $_POST['porto_desc'];
$old_date = $_POST['porto_date'];
$porto_date = date("Y-m-d", strtotime($old_date));
$porto_photo = $_FILES['porto_photo']['name'];

$q_porto = "UPDATE portos SET porto_name = '$porto_name',
            porto_desc = '$porto_desc', 
            porto_date = '$porto_date',
            porto_photo = '$porto_photo' WHERE porto_id = '$porto_id'
            ";
$r_porto = mysqli_query($conn, $q_porto);

if ($r_porto) {
    if (move_uploaded_file($_FILES['porto_photo']['tmp_name'], $path)) {
        if (file_exists($old_path)) {
            unlink($old_path);
            header('location: index.php?success=1&message=Your Porto has been updated');
        }
    }
} else {
    header('location: index.php?success=0&error=Failed to update your porto');
}
