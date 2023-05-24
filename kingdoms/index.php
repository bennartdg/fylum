<?php
session_start();
include('../server/connection.php');

if (isset($_SESSION['logged_in'])) {
  $account_id = $_SESSION['account_id'];
  $account_email = $_SESSION['account_email'];
  $account_password = $_SESSION['account_password'];
  $account_level = $_SESSION['account_level'];

  $king_id = $_SESSION['king_id'];
  $king_name = $_SESSION['king_name'];
  $king_desc = $_SESSION['king_desc'];
  $king_add = $_SESSION['king_add'];
  $king_balance = $_SESSION['king_balance'];
  $king_photo = $_SESSION['king_photo'];
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['account_id']);
    unset($_SESSION['king_id']);
    unset($_SESSION['account_level']);
    header('location: ../login.php');
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/images/icons/fy_main.png">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="../bootstrap/css/main.css" />
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/61f8d3e11d.js" crossorigin="anonymous"></script>
  <title>FyLum</title>
</head>

<body class="bg-main-purple">
  <div class="bg-light vh-100 text-dark">
    <a class="link-purple" href="index.php?logout=1">Logout</a>

    <?= $account_id ?>
    <?= $account_email ?>
    <?= $account_password ?>
    <?= $account_level ?>
    <?= $king_id ?>
    <?= $_SESSION['logged_in'] ?>
  </div>

  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>