<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: ../login.php');
}

if (isset($_SESSION['logged_in'])) {
  $account_id = $_SESSION['account_id'];
  $account_email = $_SESSION['account_email'];
  $account_password = $_SESSION['account_password'];
  $account_level = $_SESSION['account_level'];

  $fyler_id = $_SESSION['fyler_id'];
  $fyler_name = $_SESSION['fyler_name'];
  $fyler_cate = $_SESSION['fyler_cate'];
  $fyler_desc = $_SESSION['fyler_desc'];
  $fyler_age = $_SESSION['fyler_age'];
  $fyler_add = $_SESSION['fyler_add'];
  $fyler_balance = $_SESSION['fyler_balance'];
  $fyler_photo = $_SESSION['fyler_photo'];
  $fyler_project = $_SESSION['fyler_project'];
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['account_id']);
    unset($_SESSION['fyler_id']);
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://kit.fontawesome.com/61f8d3e11d.js" crossorigin="anonymous"></script>
  <title>FyLum</title>
</head>

<body class="bg-main-purple">
  <main>
    <div class="position-absolute top-0 start-50 translate-middle-x text-center mt-3">
      <a href="index.php">
        <img src="../assets/images/icons/fylum.png" alt="" height="40px">
      </a>
    </div>
    <div class="container-fluid bg-nearly-white p-0 m-0 text-dark">
      <div class="container-fluid w-75 pt-5">
        <div class="mt-4 mb-3">
          <img class="shadow w-100 rounded-3" src="../assets/images/contents/banner.png" alt="">
        </div>
        <div class="shadow p-3 d-flex rounded-3 mb-3">
          <div class="w-75">
            <div class="d-flex align-items-center ps-5">
              <img class="rounded-circle w-25 h-25" src="../assets/images/profiles/fylers/<?= $fyler_photo ?>" alt="">
              <div class="d-flex flex-column ms-5">
                <h2><?= $fyler_name ?></h2>
                <p class="fs-5"><?= $fyler_cate ?></p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center w-25 justify-content-evenly">
            <a class="" href="">
              <button class="btn btn-light-purple" style="width: 120px;">SETTINGS</button>
            </a>
            <a class="" href="index.php?logout=1">
              <button class="btn btn-purple" style="width: 120px;">LOGOUT</button>
            </a>
          </div>
        </div>
        <div class="d-flex">
          <!-- Layout Left Start -->
          <div class="w-25">
            <div class="shadow p-5 mb-3 rounded-3">
              <div>
                <h5 class="m-0">Address</h5>
                <p class="m-0 fw-light"><?= $fyler_add ?></p>
              </div>
              <div class="my-4">
                <h5 class="m-0">Email</h5>
                <p class="m-0 fw-light"><?= $account_email ?></p>
              </div>
              <div class="my-4">
                <h5 class="m-0">Age</h5>
                <p class="m-0 fw-light"><?= $fyler_age ?> Years Old</p>
              </div>
              <div>
                <h5 class="m-0">Balance</h5>
                <p class="m-0 fw-light">Rp.<?= number_format($fyler_balance) ?>.00</p>
              </div>
            </div>
            <div class="shadow py-3 rounded-3">
              <div class="border-bottom">
                <h5 class="ps-5">My Projects</h5>
                <p class="ps-5 fw-light">Count: 4</p>
              </div>
              <!-- Project List Start -->
              <div class="border-bottom project-item">
                <div class="p-3">
                  <div class="d-flex align-item-center justify-content-between m-0">
                    <h5 class="m-0">Project Name</h5>
                    <h5 class="text-main-purple">
                      <i class="fa-solid fa-bell fa-sm"></i>
                    </h5>
                  </div>
                  <p class="mb-2 fw-light">From: King Name</p>
                  <p class="m-0 fw-bold text-end fst-italic">Rp.1.000.000,00</p>
                </div>
              </div>
              <!-- Project List Start -->
              <!-- Project List Start -->
              <div class="border-bottom project-item">
                <div class="p-3">
                  <div class="d-flex align-item-center justify-content-between m-0">
                    <h5 class="m-0">Project Name</h5>
                    <h5 class="text-main-purple">
                      <i class="fa-solid fa-rotate fa-sm"></i>
                    </h5>
                  </div>
                  <p class="mb-2 fw-light">From: King Name</p>
                  <p class="m-0 fw-bold text-end fst-italic">Rp.1.000.000,00</p>
                </div>
              </div>
              <!-- Project List Start -->
              <!-- Project List Start -->
              <div class="border-bottom project-item">
                <div class="p-3">
                  <div class="d-flex align-item-center justify-content-between m-0">
                    <h5 class="m-0">Project Name</h5>
                    <h5 class="text-main-purple">
                      <i class="fa-solid fa-check fa-sm"></i>
                    </h5>
                  </div>
                  <p class="mb-2 fw-light">From: King Name</p>
                  <p class="m-0 fw-bold text-end fst-italic">Rp.1.000.000,00</p>
                </div>
              </div>
              <!-- Project List Start -->
              <!-- Project List Start -->
              <div class="border-bottom project-item">
                <div class="p-3">
                  <div class="d-flex align-item-center justify-content-between m-0">
                    <h5 class="m-0">Project Name</h5>
                    <h5 class="text-main-purple">
                      <i class="fa-solid fa-ban fa-sm"></i>
                    </h5>
                  </div>
                  <p class="mb-2 fw-light">From: King Name</p>
                  <p class="m-0 fw-bold text-end fst-italic">Rp.1.000.000,00</p>
                </div>
              </div>
              <!-- Project List Start -->
              <div class="d-flex mt-4 justify-content-evenly" style="font-size: x-small;">
                <p class="text-main-purple">
                  unread<i class="fa-solid fa-bell fa-sm"></i>
                </p>
                <p class="text-main-purple">
                  ongoing<i class="fa-solid fa-rotate fa-sm"></i>
                </p>
                <p class="text-main-purple">
                  finished<i class="fa-solid fa-check fa-sm"></i>
                </p>
                <p class="text-main-purple">
                  decline<i class="fa-solid fa-ban fa-sm"></i>
                </p>
              </div>
            </div>
          </div>
          <!-- Layout Left End -->

          <!-- Layout Right Start -->
          <div class="shadow w-75 ms-3 rounded-3">
            <div class="p-5 text-wrap">
              <h3 class="fw-bold">ABOUT ME</h3>
              <p><?= $fyler_desc ?></p>
            </div>
            <div class="px-5">
              <h3 class="fw-bold">MY PORTO</h3>

              <div class="row">
                <?php for ($i = 0; $i < 6; $i++) { ?>
                  <div class="col-lg-4 col-sm-6 d-flex flex-column align-items-center justify-content-center my-3 mx-0">
                    <div class="card card-scale rounded-3" style="height: 300px;">
                      <img src="../assets/images/contents/card1.png" class="object-fit-cover rounded-top-3" alt="" height="150px">
                      <div class="card-body">
                        <h5 class="card-tittle">Porto Name</h5>
                        <p class="card-text">Porto Description what is this porto talks aboutasdfasdf</p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>

            </div>
          </div>
          <!-- Layout Right End -->
        </div>
      </div>
    </div>
  </main>

  <footer class="pt-5 bg-nearly-white">
    <div class="pt-5">
      <div class="container-fluid bg-dark p-0">
        <div class="container">
          <div class="d-flex justify-content-center p-5">
            <a class="text-light text-decoration-none" href="">
              <div class="d-flex align-items-center justify-content-center btn-purple btn-circle rounded-circle mx-2">
                <i class="fa-brands fa-facebook-f"></i>
              </div>
            </a>
            <a class="text-light text-decoration-none" href="">
              <div class="d-flex align-items-center justify-content-center btn-purple btn-circle rounded-circle mx-2">
                <i class="fa-brands fa-google"></i>
              </div>
            </a>
            <a class="text-light text-decoration-none" href="">
              <div class="d-flex align-items-center justify-content-center btn-purple btn-circle rounded-circle mx-2">
                <i class="fa-brands fa-instagram"></i>
              </div>
            </a>
            <a class="text-light text-decoration-none" href="">
              <div class="d-flex align-items-center justify-content-center btn-purple btn-circle rounded-circle mx-2">
                <i class="fa-brands fa-linkedin"></i>
              </div>
            </a>
            <a class="text-light text-decoration-none" href="https://github.com/bennartdg/fylum" target="_blank">
              <div class="d-flex align-items-center justify-content-center btn-purple btn-circle rounded-circle mx-2">
                <i class="fa-brands fa-github"></i>
              </div>
            </a>
          </div>
          <div class="pb-5 d-flex justify-content-center">
            <div class="d-flex justify-content-evenly" style="width: 400px;">
              <a href="" class="link-light-purple">HOME</a>
              <span>|</span>
              <a href="" class="link-light-purple">PROFILE</a>
              <span>|</span>
              <a href="" class="link-light-purple">ABOUT</a>
              <span>|</span>
              <a href="" class="link-light-purple">CONTACT</a>
            </div>
          </div>
          <div class="text-center pb-5">
            <a href="index.php">
              <img src="../assets/images/icons/fylum_light.png" alt="" height="40px">
            </a>
          </div>
        </div>
        <div class="bg-secondary-purple text-center p-2">
          <p class="text-uppercase fw-semibold m-0" style="font-size: small;">Pleasure in the job puts perfection in the work | Aristotle</p>
          <p class="m-0" style="font-size: x-small;">&copy;2023 | FYLUM COMPANY | ALL RIGHT RESERVED</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>