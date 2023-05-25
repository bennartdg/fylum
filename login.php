<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
  if ($_SESSION['account_level'] == 'ancient') {
    header('location: ancients/index.php');
  } else if ($_SESSION['account_level'] == 'fyler') {
    header('location: fylers/index.php');
  } else {
    header('location: kingdoms/index.php');
  }
}

if (isset($_POST['login_btn'])) {
  $email = $_POST['account_email'];
  $password = $_POST['account_password'];

  $query = "SELECT * FROM accounts WHERE account_email =  ? AND account_password = ? LIMIT 1";

  $stmt_login = $conn->prepare($query);
  $stmt_login->bind_param('ss', $email, $password);

  if ($stmt_login->execute()) {
    $stmt_login->bind_result($account_id, $account_email, $account_password, $account_level);
    $stmt_login->store_result();

    if ($stmt_login->num_rows() == 1) {
      $stmt_login->fetch();
      if ($account_level == 'ancient') {
        $q_ancient = "SELECT * FROM ancients WHERE account_email = '$email'";
        $r_ancient = mysqli_query($conn, $q_ancient);

        $row = mysqli_fetch_assoc($r_ancient);

        $_SESSION['account_id'] = $account_id;
        $_SESSION['account_email'] = $account_email;
        $_SESSION['account_password'] = $account_password;
        $_SESSION['account_level'] = $account_level;

        $_SESSION['ancient_id'] = $row['ancient_id'];
        $_SESSION['ancient_name'] = $row['ancient_name'];
        $_SESSION['ancient_balance'] = $row['ancient_balance'];

        $_SESSION['logged_in'] = true;

        header('location: ancients/index.php');
      } else if ($account_level == 'fyler') {
        $q_fyler = "SELECT * FROM fylers WHERE account_email = '$email'";
        $r_fyler = mysqli_query($conn, $q_fyler);

        $row = mysqli_fetch_assoc($r_fyler);

        $_SESSION['account_id'] = $account_id;
        $_SESSION['account_email'] = $account_email;
        $_SESSION['account_password'] = $account_password;
        $_SESSION['account_level'] = $account_level;

        $_SESSION['fyler_id'] = $row['fyler_id'];
        $_SESSION['fyler_name'] = $row['fyler_name'];
        $_SESSION['fyler_cate'] = $row['fyler_cate'];
        $_SESSION['fyler_desc'] = $row['fyler_desc'];
        $_SESSION['fyler_age'] = $row['fyler_age'];
        $_SESSION['fyler_add'] = $row['fyler_add'];
        $_SESSION['fyler_balance'] = $row['fyler_balance'];
        $_SESSION['fyler_photo'] = $row['fyler_photo'];
        $_SESSION['fyler_project'] = $row['fyler_project'];

        $_SESSION['logged_in'] = true;

        header('location: fylers/index.php');
      } else {
        $q_king = "SELECT * FROM kings WHERE account_email = '$email'";
        $r_king = mysqli_query($conn, $q_king);

        $row = mysqli_fetch_assoc($r_king);

        $_SESSION['account_id'] = $account_id;
        $_SESSION['account_email'] = $account_email;
        $_SESSION['account_password'] = $account_password;
        $_SESSION['account_level'] = $account_level;

        $_SESSION['king_id'] = $row['king_id'];
        $_SESSION['king_name'] = $row['king_name'];
        $_SESSION['king_desc'] = $row['king_desc'];
        $_SESSION['king_add'] = $row['king_iadd'];
        $_SESSION['king_balance'] = $row['king_balance'];
        $_SESSION['king_photo'] = $row['king_photo'];

        $_SESSION['logged_in'] = true;

        header('location: kingdoms/index.php');
      }
    } else {
      header('location: login.php?success=0&error=Could not verify your account!');
    }
  } else {
    header('location: login.php?success=0&error=Something went wrong!');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/images/icons/fy_main.png">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="bootstrap/css/main.css" />
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/61f8d3e11d.js" crossorigin="anonymous"></script>
  <title>Login</title>
</head>

<body class="bg-main-purple">
  <main class="container-fluid vh-100 bg-nearly-white d-flex align-items-center justify-content-center">
    <div class="shadow rounded-3 text-dark p-4" style="width: 400px;">
      <div class="text-center pb-2">
        <h1 class="fw-bold">Login</h1>
        <p class="text-secondary">Improve your personal branding and Find your best project</p>
      </div>
      <form action="login.php" method="POST">
        <div>
          <input class="form-control my-3" type="text" name="account_email" placeholder="Email" require>
        </div>
        <div>
          <input class="form-control my-3" type="password" name="account_password" placeholder="Password" require>
        </div>
        <div>
          <input type="submit" name="login_btn" class="form-control btn btn-purple my-3" value="Login">
        </div>
        <!-- Alert Start -->
        <?php if (isset($_GET['success']) && $_GET['success'] == false) { ?>
          <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_GET['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>
        <!-- Alert Start End -->
      </form>
      <p class="text-center">New in Fylum? <a class="text-main-purple text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#modalRegisterPick">Register Now</a></p>
    </div>
    <div class="fixed-bottom text-center mb-3">
      <a href="index.php">
        <img src="assets/images/icons/fylum.png" alt="" height="40px">
      </a>
    </div>
  </main>

  <!-- Modal Register Pick Start -->
  <div class="modal fade" id="modalRegisterPick" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-main-purple text-center">
          <h1 class="text-secondary" style="font-size: 4em"><i class="fa-solid fa-question"></i></h1>
          <h1 class="">Register as</h1>
          <p class="text-secondary">King for Company, Fyler for Freelancer</p>
          <div>
            <a class="btn btn-purple" style="width: 100px;" href="registerKing.php">King</a>
            <a class="btn btn-purple" style="width: 100px;" href="registerFyler.php">Fyler</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Register Pick End -->

  <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>