<?php
include('../server/connection.php');

$king_id = $_GET['king_id'];
$fyler_id = $_GET['fyler_id'];

$project_name = $_POST['project_name'];
$project_desc = $_POST['project_desc'];
$old_start = $_POST['project_start'];
$old_end = $_POST['project_end'];

$project_start = date("Y-m-d", strtotime($old_start));
$project_end = date("Y-m-d", strtotime($old_end));

$project_cost = $_POST['project_cost'];
$project_tax = 0.1 * $project_cost;
$project_fee = $project_cost - $project_tax;

$project_status = 'unread';

$q_balance_king = "SELECT king_balance FROM kings WHERE king_id = '$king_id'";
$r_balance_king = mysqli_query($conn, $q_balance_king);
$row_balance_king = mysqli_fetch_assoc($r_balance_king);
$king_balance = $row_balance_king['king_balance'];

if ($king_balance >= $project_cost) {
  $q_project = "INSERT INTO projects VALUES
(null, '$king_id', '$fyler_id', '$project_name', '$project_desc',
'$project_start', '$project_end', '$project_cost', '$project_tax',
'$project_fee', '$project_status', null)
";

  $r_project = mysqli_query($conn, $q_project);

  $q_update_balance = "UPDATE kings SET king_balance = king_balance - '$project_cost' WHERE king_id = '$king_id'";
  $r_update_balance = mysqli_query($conn, $q_update_balance);

  if ($r_project && $r_update_balance) {
    header('location: index.php?success=1&message=Project has created successfully');
  } else {
    header('location: index.php?success=0&error=Failed to create project');
  }
} else {
  header('location: index.php?success=0&error=Failed to create project! Insufficient balance');
}
