<?php
include('server/connection.php');

if (isset($_POST['king_register'])) {
  $path = "assets/images/profiles/kings/" . basename($_FILES['king_photo']['name']);

  $email = $_POST['account_email'];
  $password = $_POST['account_password'];
  $confirm_password = $_POST['account_password_confirm'];
  $name = $_POST['king_name'];
  $desc = $_POST['king_desc'];
  $add = $_POST['king_add'];
  $photo = $_FILES['king_photo']['name'];

  $q_email_check = "SELECT * FROM accounts WHERE account_email = '$email'";
  $r_email_check = mysqli_query($conn, $q_email_check);
  $numRow = mysqli_num_rows($r_email_check);

  if ($numRow != 0) {
    header('location: registerKing.php?success=0&error=This Email is already Exist!');
  } else {
    if ($password != $confirm_password) {
      header('location: registerKing.php?success=0&error=Password does not match!');
    } else {
      $q_account = "INSERT INTO accounts VALUES
      (null, '$email', '$password', 'king');
      ";

      $r_account = mysqli_query($conn, $q_account);

      $q_king = "INSERT INTO kings VALUES 
      (null, '$email', '$name', '$desc', '$add', 0, '$photo')
      ";

      $r_king = mysqli_query($conn, $q_king);

      $move_photo = move_uploaded_file($_FILES['king_photo']['tmp_name'], $path);

      if ($r_account && $r_king && $move_photo) {
        header('location: registerKing.php?success=1&message=Account created Successfully!');
      } else {
        header('location: registerKing.php?success=0&error=Filed to created Account!');
      }
    }
  }
}
