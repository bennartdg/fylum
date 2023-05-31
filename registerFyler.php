<?php
session_start();

if (isset($_SESSION['logged_in'])) {
  if ($_SESSION['account_level'] == 'ancient') {
    header('location: ancients/index.php');
  } else if ($_SESSION['account_level'] == 'fyler') {
    header('location: fylers/index.php');
  } else {
    header('location: kingdoms/index.php');
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
  <title>FyLum</title>
</head>

<body class="bg-main-purple">
  <main class="container-fluid vh-100 bg-nearly-white d-flex align-items-center justify-content-center">
    <div class="shadow rounded-3 text-dark p-4" style="width: 800px;">
      <div class="text-center pb-2">
        <h1 class="fw-bold">Register Fyler</h1>
        <p class="text-secondary">Find your best experience only in Fylum</p>
      </div>
      <div>
        <form action="actionRegister.php" method="POST" enctype="multipart/form-data">
          <div class="d-flex w-100">
            <div class="w-50">
              <div class="px-2">
                <div class="py-2">
                  <input class="form-control" type="text" name="account_email" placeholder="Email" require>
                </div>
                <div class="py-2">
                  <input class="form-control" type="password" name="account_password" placeholder="Password" require>
                </div>
                <div class="py-2">
                  <input class="form-control" type="password" name="account_password_confirm" placeholder="Confirm Password" require>
                </div>
                <div class="py-2">
                  <textarea class="form-control" name="fyler_add" id="" cols="30" rows="3" placeholder="Address" required></textarea>
                </div>
                <div class="py-2">
                  <input class="form-control" type="file" name="fyler_photo" placeholder="Profile Photo" require>
                </div>
              </div>
            </div>
            <div class="w-50">
              <div class="px-2">
                <div class="py-2">
                  <input class="form-control" type="text" name="fyler_name" placeholder="Name" require>
                </div>
                <div class="py-2">
                  <select class="form-select" name="fyler_cate" aria-label="Default select example" require>
                    <option value="Graphic Designer" selected>Graphic Designer</option>
                    <option value="Photographer">Photographer</option>
                    <option value="Architecture Designer">Architecture Designer</option>
                  </select>
                </div>
                <div class="py-2">
                  <input class="form-control" type="number" name="fyler_age" placeholder="Age" require>
                </div>
                <div class="py-2">
                  <textarea class="form-control" name="fyler_desc" id="" cols="30" rows="3" placeholder="Yourself Description" required></textarea>
                </div>
                <div class="py-2">
                  <input class="form-control btn btn-purple" type="submit" name="fyler_register" value="Register">
                </div>
              </div>
            </div>
          </div>
          <div class="px-2">
            <!-- Alert Start -->
            <?php if (isset($_GET["success"]) && $_GET["success"] == true) { ?>
              <div id="alert" class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <?php echo $_GET['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } ?>
            <?php if (isset($_GET['success']) && $_GET['success'] == false) { ?>
              <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_GET['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } ?>
            <!-- Alert Start End -->
          </div>
          <p class="text-center mt-4">Already have an Account? <a class="text-main-purple text-decoration-none" href="login.php">Login Now</a></p>
        </form>
      </div>
    </div>
    <div class="fixed-bottom text-center mb-3">
      <a href="index.php">
        <img src="assets/images/icons/fylum.png" alt="" height="40px">
      </a>
    </div>
  </main>


  <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>