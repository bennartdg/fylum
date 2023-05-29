<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: ../login.php');
} else {
  if (!isset($_SESSION['king_id'])) {
    header('location: ../login.php');
  }
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
 FROM projects p JOIN fylers f ON f.fyler_id = p.fyler_id WHERE king_id = $king_id ORDER BY f.fyler_name";
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
  <title>Dashboard King</title>
</head>

<body class="bg-main-purple">
  <main>
    <div class="position-absolute top-0 start-50 translate-middle-x text-center mt-3">
      <a href="../index.php">
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
            <!-- Alert Start -->
            <?php if (isset($_GET["success"]) && $_GET["success"] == true) { ?>
              <div id="alert" class="alert alert-success alert-dismissible fade show me-3" role="alert">
                <?php echo $_GET['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } else if (isset($_GET['success']) && $_GET['success'] == false) { ?>
              <div id="alert" class="alert alert-danger alert-dismissible fade show me-3" role="alert">
                <?php echo $_GET['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php } ?>
            <!-- Alert End -->
            <?php while ($row = mysqli_fetch_assoc($r_fyler)) { ?>
              <a class="text-dark text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#modalFylerDetail<?= $row['fyler_id'] ?>">
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
              </a>
              <!-- Modal Detail Fyler Start -->
              <div class="modal fade" id="modalFylerDetail<?= $row['fyler_id'] ?>" tabindex="-1" aria-labelledby="modalFylerDetail" aria-hidden="true">
                <?php
                $fyler_id = $row['fyler_id'];
                $q_porto = "SELECT * FROM portos WHERE fyler_id = '$fyler_id' ORDER BY porto_date DESC";
                $r_porto = mysqli_query($conn, $q_porto);
                ?>
                <div class="modal-dialog modal-dialog-centered modal-xl">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="d-flex justify-content-between w-100">
                        <div class="d-flex align-items-end text-main-purple w-50 justify-content-between">
                          <h1 class="fw-bold">FYLER</h1>
                          <h3 class="fw-bold">FYLER</h3>
                          <h6 class="fw-bold">FYLER</h6>
                        </div>
                        <div class="d-flex w-50 justify-content-end">
                          <a class="btn btn-close text-light" type="button" data-bs-dismiss="modal" aria-label="Close"></a>
                        </div>
                      </div>
                      <div class="p-5 d-flex">
                        <div class="w-75">
                          <div class="d-flex align-items-center">
                            <div>
                              <img class="rounded-circle object-fit-cover" src="../assets/images/profiles/fylers/<?= $row['fyler_photo'] ?>" alt="" width="150px" height="150px">
                            </div>
                            <div class="ms-3">
                              <h2 class="m-0"><?= $row['fyler_name'] ?></h2>
                              <p class="m-0 fs-5"><?= $row['account_email'] ?></p>
                              <p class="text-secondary"><?= $row['fyler_add'] ?></p>
                            </div>
                          </div>
                          <div class="mt-3 pe-3" style="height: 215px;">
                            <div class="d-flex flex-column">
                              <div class="mb-auto">
                                <p class="fs-4"><?= $row['fyler_cate'] ?></p>
                                <p class="fw-light"><?= $row['fyler_desc'] ?></p>
                              </div>
                              <div class="">
                                <a class="btn btn-purple" href="" style="width: 100px;" data-bs-toggle="modal" data-bs-target="#modalHire<?= $fyler_id ?>">HIRE</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="w-25 pt-3 px-3">
                          <h2 class="fw-bold ps-2">PORTO</h2>
                          <div class="overflow-y-auto rounded-3" style="height: 320px;">
                            <?php while ($p_row = mysqli_fetch_assoc($r_porto)) { ?>
                              <div class="col-lg-12 col-sm-12 d-flex flex-column align-items-center justify-content-center my-3 px-2">
                                <div class="card rounded-3" style="height: 300px;">
                                  <img src="../assets/images/portos/<?= $p_row['porto_photo'] ?>" class="object-fit-cover rounded-top-3 w-100" alt="" height="150px">
                                  <div class="card-body">
                                    <h5 class="card-tittle"><?= $p_row['porto_name'] ?></h5>
                                    <p class="card-text"><?= $p_row['porto_desc'] ?></p>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Detail Fyler End -->

              <!-- Modal Hire Fyler Start -->
              <div class="modal fade" id="modalHire<?= $row['fyler_id'] ?>" tabindex="-1" aria-labelledby="modalHire" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="d-flex align-items-end text-main-purple w-75 justify-content-between">
                        <h1 class="fw-bold">HIRE</h1>
                        <h3 class="fw-bold">FYLER</h3>
                        <h6 class="fw-bold">PROJECT</h6>
                      </div>
                      <div class="d-flex p-3 border-bottom">
                        <div>
                          <img class="rounded-circle object-fit-cover" src="../assets/images/profiles/fylers/<?= $row['fyler_photo'] ?>" alt="" width="100px" height="100px">
                        </div>
                        <div class="ms-3">
                          <h3 class="m-0"><?= $row['fyler_name'] ?></h3>
                          <p class="m-0 fs-5"><?= $row['fyler_cate'] ?></p>
                          <p class="text-secondary"><?= $row['account_email'] ?></p>
                        </div>
                      </div>
                      <form class="p-3" action="actionInsertProject.php?king_id=<?= $king_id ?>&fyler_id=<?= $row['fyler_id'] ?>" method="POST">
                        <div class="d-flex">
                          <div class="w-50 me-3">
                            <div class="mb-3">
                              <label class="mb-2" for="">Project Name</label>
                              <input class="form-control" type="text" name="project_name" required>
                            </div>
                            <div class="mb-3">
                              <label class="mb-2" for="">Project Description</label>
                              <textarea class="form-control" name="project_desc" id="" cols="30" rows="5" required></textarea>
                            </div>
                          </div>
                          <div class="w-50">
                            <div class="mb-3">
                              <label class="mb-2" for="">Project Start Date</label>
                              <input class="form-control" type="date" name="project_start" required>
                            </div>
                            <div class="mb-3">
                              <label class="mb-2" for="">Project End Date</label>
                              <input class="form-control" type="date" name="project_end" required>
                            </div>
                            <div class="mb-3">
                              <label class="mb-2" for="">Project Cost</label>
                              <input class="form-control" type="number" name="project_cost" min="10000" max="<?= $king_balance ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex mb-3 justify-content-end">
                          <a class="btn btn-light-purple me-2" style="width: 100px;" href="" data-bs-toggle="modal" data-bs-target="#modalFylerDetail<?= $fyler_id ?>">BACK</a>
                          <input class="btn btn-purple" type="submit" name="hire_project" value="START PROJECT">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Hire Fyler End -->
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
                  <a class="text-dark text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#modalProject<?= $row['project_id'] ?>">
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
                  </a>

                  <!-- Project Modal Start -->
                  <div class="modal fade" id="modalProject<?= $row['project_id'] ?>" tabindex="-1" aria-labelledby="modalProjectLabel" aria-hidden="true">
                    <?php
                    $fyler_id = $row['fyler_id'];
                    $q_fyler = "SELECT * FROM fylers WHERE fyler_id = '$fyler_id'";
                    $r_fyler = mysqli_query($conn, $q_fyler);
                    $row_fyler = mysqli_fetch_assoc($r_fyler);
                    ?>
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                        <div class="modal-body">
                          <div class="d-flex w-100 justify-content-between">
                            <div>
                              <h1 class="text-capitalize fw-bold"><span class="text-main-purple"><?= $row['project_status'] ?></span> Project</h1>
                            </div>
                            <div>
                              <a class="btn btn-close text-light" type="button" data-bs-dismiss="modal" aria-label="Close"></a>
                            </div>
                          </div>
                          <div class="d-flex p-3 border-bottom">
                            <div>
                              <img class="rounded-circle object-fit-cover" src="../assets/images/profiles/fylers/<?= $row_fyler['fyler_photo'] ?>" alt="" width="100px" height="100px">
                            </div>
                            <div class="ms-3">
                              <h3 class="m-0">With <?= $row_fyler['fyler_name'] ?></h3>
                              <p class="m-0 fs-5"><?= $row_fyler['fyler_cate'] ?></p>
                              <p class="text-secondary"><?= $row_fyler['account_email'] ?></p>
                            </div>
                          </div>
                          <div class="d-flex w-100 p-3">
                            <div class="w-75">
                              <p class="fs-4 fw-bold"><?= $row['project_name'] ?></p>
                              <p class="fw-light pe-3"><?= $row['project_desc'] ?></p>
                            </div>
                            <div class="border-start w-25">
                              <div class="mb-2 px-3">
                                <p class="fs-6 m-0">Start Date</p>
                                <p class="fw-light"><?= $row['project_start'] ?></p>
                              </div>
                              <div class="mb-2 px-3">
                                <p class="fs-6 m-0">End Date</p>
                                <p class="fw-light"><?= $row['project_end'] ?></p>
                              </div>
                              <div class="mb-2 px-3">
                                <p class="fs-6 m-0">Project Cost</p>
                                <p class="fw-light">Rp.<?= number_format($row['project_cost']) ?>.00</p>
                              </div>
                            </div>
                          </div>
                          <?php if ($row['project_status'] == 'unread') { ?>
                            <div class="w-75 px-3 text-end">
                              <a class="btn btn-light-purple" href="actionDeclineProject.php?project_id=<?= $row['project_id'] ?>&project_cost=<?= $row['project_cost'] ?>">Decline</a>
                            </div>
                          <?php } else if ($row['project_status'] == 'ongoing') { ?>
                            <div class="d-flex px-3">
                              <div class="d-flex w-75">
                                <div class="">
                                  <p class="fw-light m-0">If you choose not to proceed with this project, please select "Decline."</p>
                                </div>
                                <div class="ms-2">
                                  <a class="btn btn-light-purple" href="actionDeclineProject.php?project_id=<?= $row['project_id'] ?>&project_cost=<?= $row['project_cost'] ?>">Decline</a>
                                </div>
                              </div>
                            </div>
                          <?php } else if ($row['project_status'] == 'finished') { ?>
                            <div class="w-100 text-center d-flex flex-column align-items-center">
                              <div class="p-2 mb-3 shadow rounded-3 bg-secondary-purple" style="width: max-content;">
                                <h6>Project Delivery</h6>
                                <img class="object-fit-cover rounded-3" src="../assets/images/projects/<?= $row['project_deliv'] ?>" alt="" width="300px" height="100px">
                              </div>
                              <p class="fw-bold">This Project is finished</p>
                            </div>
                          <?php } else { ?>
                            <div class="w-100 text-center">
                              <p class="fw-bold">This Project has declined</p>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Project Modal End -->
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
                    declined<i class="fa-solid fa-ban fa-sm"></i>
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

  <?php include('../layouts/footer.php'); ?>

  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>