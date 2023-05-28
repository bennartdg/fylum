<?php
include('../server/connection.php');

$king_id = $_GET['king_id'];
$king_balance = $_POST['king_balance'];

$q_topup = "UPDATE kings SET king_balance = king_balance + '$king_balance' 
WHERE king_id = '$king_id'";
$r_topup = mysqli_query($conn, $q_topup);

if ($r_topup) {
  header('location: index.php?success=1&message=Balance has been added');
} else {
  header('location: index.php?success=0&error=Failed to add Balance');
}
