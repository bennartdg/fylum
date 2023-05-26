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

<?php
if (isset($_POST['btn_search'])) {
  $keyword = $_POST['keyword'];
  $q_fyler = "SELECT * FROM fylers WHERE fyler_name LIKE '%$keyword%' OR fyler_cate LIKE '%$keyword%'";
} else {
  $q_fyler = "SELECT * FROM fylers";
}
$r_fyler = mysqli_query($conn, $q_fyler);
?>

<?php
$q_projects = "SELECT p.project_id, p.king_id, f.fyler_name,
p.fyler_id, p.project_name, p.project_desc, p.project_start,
p.project_end, p.project_cost, p.project_tax, p.project_fee,
p.project_status, p.project_deliv
 FROM projects p JOIN fylers f ON f.fyler_id = p.fyler_id WHERE king_id = $king_id";
$r_projects = mysqli_query($conn, $q_projects);
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
  <main>
    <div class="position-absolute top-0 start-50 translate-middle-x text-center mt-3">
      <a href="index.php">
        <img src="../assets/images/icons/fylum.png" alt="" height="40px">
      </a>
    </div>
    <div class="container-fluid bg-nearly-white p-0 m-0 text-dark">
      <div class="container-fluid w-75 pt-5">
        <div class="d-flex mt-4">
          <!-- Left -->
          <div class="w-75">
            <div class="mb-3 me-3">
              <img class="shadow rounded-3 w-100 h-100" src="../assets/images/contents/banner_king.png" alt="">
            </div>
            <div class="mb-3 me-3">
              <h2 class="fw-normal">Let's find you a <span class="fw-bold text-main-purple">Fyler</span></h2>
              <p class="text-secondary">See what you like</p>
            </div>
            <div class="mb-3 me-3">
              <form action="" method="POST">
                <div class="d-flex">
                  <input class="form-control" type="text" name="keyword" placeholder="Search a Fyler...">
                  <button class="btn btn-purple ms-2" name="btn_search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
              </form>
            </div>
            <?php while ($row = mysqli_fetch_assoc($r_fyler)) { ?>
              <div class="mb-3 me-3">
                <div class="shadow card-scale-1 rounded-3">
                  <div class="d-flex p-5">
                    <div>
                      <img class="object-fit-cover rounded-circle" src="../assets/images/profiles/fylers/<?= $row['fyler_photo'] ?>" alt="" height="150px" width="150px">
                    </div>
                    <div class="ms-4">
                      <h4><?= $row['fyler_name'] ?></h4>
                      <p><?= $row['fyler_cate'] ?></p>
                      <p class="fw-light"><?= $row['fyler_desc'] ?></p>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
          <!-- Left -->
          <!-- Right -->
          <div class="w-25">
            <div class="mb-3">
              <div class="shadow pt-5 px-3 mb-3 rounded-3">
                <div class="text-center">
                  <img class="object-fit-cover rounded-circle" src="../assets/images/profiles/kings/<?= $king_photo ?>" alt="" height="100px" width="100px">
                </div>
                <div class="my-3 text-center">
                  <h5><?= $king_name ?></h5>
                  <p><?= $king_desc ?></p>
                </div>
                <div class="border-top border-bottom px-3 pt-3 text-center">
                  <p class="fw-light"><?= $king_add ?></p>
                </div>
                <div class="py-3 text-center">
                  <h6 class="0-0">Balance</h6>
                  <p class="m-0 fw-light">Rp.<?= number_format($king_balance) ?>.00</p>
                </div>
                <div class="text-center pb-3">
                  <a class="" href="index.php?logout=1">
                    <button class="btn btn-purple" style="width: 120px;">LOGOUT</button>
                  </a>
                </div>
              </div>
              <div class="shadow py-3 rounded-3">
                <div class="border-bottom">
                  <h5 class="ps-5">Projects</h5>
                  <p class="ps-5 fw-light">Count: <?= mysqli_num_rows($r_projects) ?></p>
                </div>
                <!-- Project List Start -->
                <?php while ($row = mysqli_fetch_assoc($r_projects)) { ?>
                  <!-- Icon Logic -->
                  <?php if ($row['project_status'] == 'unread') {
                    $icon_stat = '<i class="fa-solid fa-bell fa-sm"></i>';
                  } else if ($row['project_status'] == 'ongoing') {
                    $icon_stat = '<i class="fa-solid fa-rotate fa-sm"></i>';
                  } else if ($row['project_status'] == 'finished') {
                    $icon_stat = '<i class="fa-solid fa-check fa-sm"></i>';
                  } else {
                    $icon_stat = '<i class="fa-solid fa-ban fa-sm"></i>';
                  } ?>
                  <!-- Icon Logic -->
                  <div class="border-bottom project-item">
                    <div class="d-flex flex-column p-3 justify-content-end">
                      <div class="d-flex align-item-center justify-content-between m-0">
                        <h5 class="m-0"><?= $row['project_name'] ?></h5>
                        <h5 class="text-main-purple">
                          <?= $icon_stat ?>
                        </h5>
                      </div>
                      <p class="mb-2 fw-light">Fyler: <?= $row['fyler_name'] ?></p>
                      <p class="m-0 fw-bold text-end fst-italic">Rp<?= number_format($row['project_cost']) ?>.00</p>
                    </div>
                  </div>
                <?php } ?>
                <!-- Project List End -->
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
          </div>
          <!-- Right -->
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>