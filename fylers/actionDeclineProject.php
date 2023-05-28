<?php
include('../server/connection.php');

$project_id = $_GET['project_id'];

$q_project = "UPDATE projects SET project_status = 'declined' WHERE project_id = '$project_id'";
$r_project = mysqli_query($conn, $q_project);

if ($r_project) {
  header('location: index.php?success=1&message=Project Declined');
} else {
  header('location: index.php?success=0&error=Failed to declined Project');
}
