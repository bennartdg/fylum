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

$q_project = "INSERT INTO projects VALUES
(null, '$king_id', '$fyler_id', '$project_name', '$project_desc',
'$project_start', '$project_end', '$project_cost', '$project_tax',
'$project_fee', '$project_status', null)
";

$r_project = mysqli_query($conn, $q_project);

if ($r_project) {
  header('location: index.php?success=1&message=Project has created successfully');
} else {
  header('location: index.php?success=0&error=Failed to create project');
}
