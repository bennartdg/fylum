<?php
include('../server/connection.php');

$project_id = $_GET['project_id'];
$project_cost = $_GET['project_cost'];

$q_project = "UPDATE projects SET project_status = 'declined' WHERE project_id = '$project_id'";
$r_project = mysqli_query($conn, $q_project);

$q_select_king = "SELECT king_id FROM projects WHERE project_id = '$project_id'";
$r_select_king = mysqli_query($conn, $q_select_king);
$row_select_king = mysqli_fetch_assoc($r_select_king);
$king_id = $row_select_king['king_id'];

$q_update_balance = "UPDATE kings SET king_balance = king_balance + '$project_cost' WHERE king_id = '$king_id'";
$r_update_balance = mysqli_query($conn, $q_update_balance);

if ($r_project && $r_update_balance) {
  header('location: index.php?success=1&message=Project Declined');
} else {
  header('location: index.php?success=0&error=Failed to declined Project');
}
