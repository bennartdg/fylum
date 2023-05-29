<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: ../login.php');
} else {
  if (!isset($_SESSION['ancient_id'])) {
    header('location: ../login.php');
  }
}

if (isset($_SESSION['logged_in'])) {
  $account_id = $_SESSION['account_id'];
  $account_email = $_SESSION['account_email'];
  $account_password = $_SESSION['account_password'];
  $account_level = $_SESSION['account_level'];

  $ancient_id = $_SESSION['ancient_id'];
  $ancient_name = $_SESSION['ancient_name'];
  $ancient_balance = $_SESSION['ancient_balance'];
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    unset($_SESSION['logged_in']);
    unset($_SESSION['account_id']);
    unset($_SESSION['ancient_id']);
    unset($_SESSION['account_level']);
    header('location: ../login.php');
    exit();
  }
}



?>

<?php
$q_t_project = "SELECT COUNT(*) AS total_project FROM projects";
$r_t_project = mysqli_query($conn, $q_t_project);
$row_t_project = mysqli_fetch_assoc($r_t_project);
$total_project = $row_t_project['total_project'];
?>

<?php
$q_t_cost = "SELECT SUM(project_cost) AS total_cost FROM projects WHERE project_status = 'finished'";
$r_t_cost = mysqli_query($conn, $q_t_cost);
$row_t_cost = mysqli_fetch_assoc($r_t_cost);
$total_cost = $row_t_cost['total_cost'];
?>

<?php
if (isset($_POST['btn_search_Fyler'])) {
  $keyword = $_POST['keyword'];
  $q_fyler = "SELECT * FROM fylers WHERE fyler_id LIKE '%$keyword%' OR
  fyler_name LIKE '%$keyword%' OR fyler_cate LIKE '%$keyword%' OR fyler_add LIKE '%$keyword%'";
} else {
  $q_fyler = "SELECT * FROM fylers";
}
$r_fyler = mysqli_query($conn, $q_fyler);

$q_fyler_all = "SELECT * FROM fylers";
$r_fyler_all = mysqli_query($conn, $q_fyler_all);
$total_fyler = mysqli_num_rows($r_fyler_all);
?>

<?php

if (isset($_POST['btn_search_King'])) {
  $keyword = $_POST['keyword'];
  $q_king = "SELECT * FROM kings WHERE king_id LIKE '%$keyword%' OR
  king_name LIKE '%$keyword%' OR king_desc LIKE '%$keyword%' OR king_add LIKE '%$keyword%'";
} else {
  $q_king = "SELECT * FROM kings";
}
$r_king = mysqli_query($conn, $q_king);

$q_king_all = "SELECT * FROM kings";
$r_king_all = mysqli_query($conn, $q_king_all);
$total_king = mysqli_num_rows($r_king_all);
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
  <title>Dashboard Ancient</title>
</head>

<body class="bg-main-purple">
  <main>
    <div class="position-absolute top-0 start-50 translate-middle-x text-center mt-3">
      <a href="index.php">
        <img src="../assets/images/icons/fylum.png" alt="" height="40px">
      </a>
    </div>
    <div class="container-fluid bg-nearly-white pb-3 m-0 text-dark">
      <div class="container-fluid w-75 pt-5">
        <div class="mt-4 mb-3">
          <img class="shadow w-100 rounded-3" src="../assets/images/contents/banner_ancient.png" alt="">
        </div>
        <div class="d-flex mb-5">
          <div class="shadow w-25 rounded-3 mb-3 ps-3 me-3 bg-main-purple">
            <div class="bg-nearly-white text-dark w-100 h-100 p-3 rounded-end-3">
              <h3 class="fw-bold">Total Project</h3>
              <p class="fw-light fs-5">
                <?= $total_project ?> Projects
              </p>
              <h1 class="text-end text-main-grey"><i class="fa-solid fa-chart-simple"></i></h1>
            </div>
          </div>
          <div class="shadow w-25 rounded-3 mb-3 me-3 p-3">
            <h3 class="fw-bold">Projects Cost</h3>
            <p class="fw-light fs-5">Rp.
              <?= number_format($total_cost) ?>.00
            </p>
            <h1 class="text-end text-main-grey"><i class="fa-solid fa-money-bill-transfer"></i></h1>
          </div>
          <div class="shadow w-25 rounded-3 mb-3 me-3 p-3">
            <h3 class="fw-bold">Fyler Active</h3>
            <p class="fw-light fs-5">
              <?= $total_fyler ?> Fylers
            </p>
            <h1 class="text-end text-main-grey"><i class="fa-solid fa-laptop"></i></h1>
          </div>
          <div class="shadow w-25 rounded-3 mb-3 p-3">
            <h3 class="fw-bold">Kings Active</h3>
            <p class="fw-light fs-5">
              <?= $total_king ?> Kings
            </p>
            <h1 class="text-end text-main-grey"><i class="fa-solid fa-crown"></i></h1>
          </div>
        </div>
        <div class="d-flex mt-5">
          <div class="w-50 mb-3 me-3">
            <div class="w-100">
              <?php if (isset($_GET['tbl'])) {
                if ($_GET['tbl'] == 'fyler') {
                  $indicator = 'Fyler';
                } else {
                  $indicator = 'King';
                }
              } else {
                $indicator = 'Fyler';
              } ?>
              <form action="" method="POST">
                <div class="d-flex mb-3">
                  <input class="form-control" type="text" name="keyword" placeholder="Search a <?= $indicator ?>...">
                  <button class="btn btn-purple ms-2" type="submit" name="btn_search_<?= $indicator ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
              </form>
              <?php if (isset($_GET['tbl'])) {
                if ($_GET['tbl'] == 'fyler') {
                  $btn_king = 'btn-light-purple';
                  $btn_fyler = 'btn-purple';
                } else {
                  $btn_king = 'btn-purple';
                  $btn_fyler = 'btn-light-purple';
                }
              } else {
                $btn_king = 'btn-light-purple';
                $btn_fyler = 'btn-purple';
              } ?>
              <div class="w-100 d-flex">
                <a class="text-decoration-none shadow w-50 p-4 rounded-3 text-center <?= $btn_fyler ?>" href="index.php?tbl=fyler">
                  <h1 class="fw-bold">FYLERS</h1>
                </a>
                <a class="shadow w-50 p-4 ms-3 rounded-3 text-center text-decoration-none <?= $btn_king ?>" href="index.php?tbl=king">
                  <h1 class="fw-bold">KINGS</h1>
                </a>
              </div>
            </div>
          </div>
          <div class="shadow w-50 mb-3 rounded-3 px-3">
            <div class="d-flex mx-3 py-3 align-items-center">
              <img class="object-fit-cover rounded-circle" src="../assets/images/icons/fy_main.png" alt="" height="70px" width="70px">
              <div class="d-flex align-items-center justify-content-between w-100">
                <h4 class="fw-bold ms-3">Ancient</h4>
                <a class="" href="index.php?logout=1">
                  <button class="btn btn-purple" style="width: 120px;">LOGOUT</button>
                </a>
              </div>
            </div>
            <div class="d-flex mx-3 px-2 pt-2 border-top">
              <h5>Balance:</h5>
              <p class="ms-3">Rp.
                <?= number_format($ancient_balance) ?>.00
              </p>
            </div>
          </div>
        </div>

        <!-- Alert Start -->
        <?php if (isset($_GET["success"]) && $_GET["success"] == true) { ?>
          <div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } else if (isset($_GET['success']) && $_GET['success'] == false) { ?>
          <div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $_GET['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php } ?>
        <!-- Alert End -->

        <div class="shadow rounded-3">
          <div class="w-100">
            <table class="table">
              <thead class="text-center fw-bold">
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <?php if ($indicator == 'Fyler') { ?>
                  <th scope="col">Category</th>
                  <th scope="col">Address</th>
                <?php } else { ?>
                  <th scope="col">Description</th>
                  <th scope="col">Balance</th>
                  <th scope="col">Action</th>
                <?php } ?>
              </thead>
              <!-- While -->
              <?php if (isset($_GET['tbl'])) { ?>
                <?php if ($_GET['tbl'] == 'fyler') { ?>
                  <?php while ($row = mysqli_fetch_assoc($r_fyler)) { ?>
                    <tr class="text-center table-row">
                      <td>
                        <?= $row['fyler_id'] ?>
                      </td>
                      <td>
                        <?= $row['fyler_name'] ?>
                      </td>
                      <td>
                        <?= $row['fyler_cate'] ?>
                      </td>
                      <td>
                        <?= $row['fyler_add'] ?>
                      </td>
                    </tr>
                  <?php } ?>
                <?php } else { ?>
                  <?php while ($row = mysqli_fetch_assoc($r_king)) { ?>
                    <tr class="text-center table-row">
                      <td>
                        <?= $row['king_id'] ?>
                      </td>
                      <td>
                        <?= $row['king_name'] ?>
                      </td>
                      <td>
                        <?= $row['king_desc'] ?>
                      </td>
                      <td>
                        <?= 'Rp.' . number_format($row['king_balance']) . '.00'  ?>
                      </td>
                      <td>
                        <a class="link-purple" href="" data-bs-toggle="modal" data-bs-target="#modalTopup<?= $row['king_id'] ?>">
                          <i class="fa-solid fa-wallet fa-lg"></i>
                        </a>
                      </td>
                    </tr>

                    <!-- Modal Topup Start -->
                    <div class="modal fade" id="modalTopup<?= $row['king_id'] ?>" tabindex="-1" aria-labelledby="modalTopupLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-body">
                            <div class="d-flex align-items-end text-main-purple w-100 justify-content-between">
                              <h1 class="fw-bold">TOPUP</h1>
                              <h3 class="fw-bold">TOPUP</h3>
                              <h6 class="fw-bold">KINGS</h6>
                            </div>
                            <div class="d-flex p-3">
                              <div class="w-75">
                                <div class="d-flex align-items-center">
                                  <div>
                                    <img class="rounded-circle object-fit-cover" src="../assets/images/profiles/kings/<?= $row['king_photo'] ?>" alt="" height="100px" width="100px">
                                  </div>
                                  <div class="ms-3">
                                    <p class="m-0">#<?= $row['king_id'] ?></p>
                                    <p class="m-0 fs-4"><?= $row['king_name'] ?></p>
                                    <p class="m-0 text-secondary"><?= $row['account_email'] ?></p>
                                    <p class="m-0 fw-bold text-main-purple"><?= 'Rp.' . number_format($row['king_balance']) . '.00' ?></p>
                                  </div>
                                </div>
                                <form action="actionTopup.php?king_id=<?= $row['king_id'] ?>" method="POST">
                                  <label class="mt-3" for="">Insert Nominal</label>
                                  <div class="d-flex">
                                    <input class="form-control" type="number" name="king_balance" placeholder="Rp." min="100000" max="1000000000" step="100000">
                                    <input class="btn btn-purple" type="submit" value="Topup">
                                  </div>
                                  <label class="m-0 text-secondary" for="">(Rp.10,000 - Rp.1,000,000,000)</label>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Topup End -->

                  <?php } ?>
                <?php } ?>
              <?php } else if (!isset($_GET['tbl'])) { ?>
                <?php while ($row = mysqli_fetch_assoc($r_fyler)) { ?>
                  <tr class="text-center table-row">
                    <td>
                      <?= $row['fyler_id'] ?>
                    </td>
                    <td>
                      <?= $row['fyler_name'] ?>
                    </td>
                    <td>
                      <?= $row['fyler_cate'] ?>
                    </td>
                    <td>
                      <?= $row['fyler_add'] ?>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
              <!-- While -->
              <tr class="bg-main-purple w-100">
                <td class="rounded-bottom-3" colspan="5"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include('../layouts/footer.php'); ?>

  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>