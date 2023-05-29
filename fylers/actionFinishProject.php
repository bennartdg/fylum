<?php

include('../server/connection.php');

$project_id = $_GET['project_id'];

$q_select = "SELECT king_id, fyler_id, project_cost, project_tax, project_fee FROM projects WHERE project_id = '$project_id'";
$r_select = mysqli_query($conn, $q_select);

$row_select = mysqli_fetch_assoc($r_select);
$project_cost = $row_select['project_cost'];
$project_tax = $row_select['project_tax'];
$project_fee = $row_select['project_fee'];

$king_id = $row_select['king_id'];
$fyler_id = $row_select['fyler_id'];

$q_ancient = "UPDATE ancients SET ancient_balance = ancient_balance + '$project_tax'";
$r_anceint = mysqli_query($conn, $q_ancient);

$q_fyler = "UPDATE fylers SET fyler_balance = fyler_balance + '$project_fee', fyler_project = fyler_project + 1 WHERE fyler_id = '$fyler_id'";
$r_fyler = mysqli_query($conn, $q_fyler);

$path = "../assets/images/projects/" . basename($_FILES['project_deliv']['name']);

$project_deliv = $_FILES['project_deliv']['name'];

$q_project = "UPDATE projects SET project_status = 'finished', project_deliv = '$project_deliv' WHERE project_id = '$project_id'";
$r_project = mysqli_query($conn, $q_project);

if ($r_project && $r_anceint && $r_fyler) {
  if (move_uploaded_file($_FILES['project_deliv']['tmp_name'], $path)) {
    header('location: index.php?success=1&message=Project Finished');
  }
} else {
  header('location: index.php?success=0&error=Failed to submit Project Delivery');
}
