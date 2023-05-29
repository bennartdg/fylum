<?php
session_start();
include('../server/connection.php');

if (!isset($_SESSION['logged_in'])) {
  header('location: ../login.php');
} else {
  if (!isset($_SESSION['fyler_id'])) {
    header('location: ../login.php');
  }
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
<!-- Portos -->
<?php
$q_portos = "SELECT * FROM portos WHERE fyler_id = $fyler_id ORDER BY porto_date DESC";
$r_portos = mysqli_query($conn, $q_portos);
?>
<!-- Portos -->

<!-- Projects -->
<?php
$q_projects = "SELECT p.project_id, p.king_id, k.king_name,
p.fyler_id, p.project_name, p.project_desc, p.project_start,
p.project_end, p.project_cost, p.project_tax, p.project_fee,
p.project_status, p.project_deliv
 FROM projects p JOIN kings k ON p.king_id = k.king_id WHERE fyler_id = $fyler_id ORDER BY p.project_status DESC";
$r_projects = mysqli_query($conn, $q_projects);
?>
<!-- Projects -->

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
  <title>Dashboard Fyler</title>
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
        <div class="mt-4 mb-3">
          <img class="shadow w-100 rounded-3" src="../assets/images/contents/banner.png" alt="">
        </div>
        <div class="shadow p-3 d-flex rounded-3 mb-3">
          <div class="w-75">
            <div class="d-flex align-items-center ps-5">
              <img class="object-fit-cover rounded-circle" src="../assets/images/profiles/fylers/<?= $fyler_photo ?>" alt="" height="200px" width="200px">
              <div class="d-flex flex-column ms-5">
                <h2><?= $fyler_name ?></h2>
                <p class="fs-5"><?= $fyler_cate ?></p>
              </div>
            </div>
          </div>
          <div class="d-flex align-items-center w-25 justify-content-evenly">
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
                    <div class="p-3">
                      <div class="d-flex align-item-center justify-content-between m-0">
                        <h5 class="m-0"><?= $row['project_name'] ?></h5>
                        <h5 class="text-main-purple">
                          <?= $icon_stat ?>
                        </h5>
                      </div>
                      <p class="mb-2 fw-light">From: <?= $row['king_name'] ?></p>
                      <p class="m-0 fw-bold text-end fst-italic">Rp<?= number_format($row['project_fee']) ?>.00</p>
                    </div>
                  </div>
                </a>

                <!-- Modal Project Start -->
                <div class="modal fade" id="modalProject<?= $row['project_id'] ?>" tabindex="-1" aria-labelledby="modalProjectLabel" aria-hidden="true">
                  <?php
                  $king_id = $row['king_id'];
                  $q_king = "SELECT * FROM kings WHERE king_id = '$king_id'";
                  $r_king = mysqli_query($conn, $q_king);
                  $row_king = mysqli_fetch_assoc($r_king);
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
                            <img class="rounded-circle object-fit-cover" src="../assets/images/profiles/kings/<?= $row_king['king_photo'] ?>" alt="" width="100px" height="100px">
                          </div>
                          <div class="ms-3">
                            <h3 class="m-0">From <?= $row_king['king_name'] ?></h3>
                            <p class="m-0 fs-5"><?= $row_king['king_desc'] ?></p>
                            <p class="text-secondary"><?= $row_king['account_email'] ?></p>
                          </div>
                        </div>
                        <div class="d-flex w-100 p-3">
                          <div class="w-75">
                            <p class="fs-4 fw-bold"><?= $row['project_name'] ?></p>
                            <p class="fw-light pe-2"><?= $row['project_desc'] ?></p>
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
                              <p class="fs-6 m-0">Fyler Fee</p>
                              <p class="fw-light">Rp.<?= number_format($row['project_fee']) ?>.00</p>
                            </div>
                          </div>
                        </div>
                        <?php if ($row['project_status'] == 'unread') { ?>
                          <div class="w-100 text-end pe-3">
                            <a class="btn btn-light-purple" href="actionDeclineProject.php?project_id=<?= $row['project_id'] ?>&project_cost=<?= $row['project_cost'] ?>&project_cost=<?= $row['project_cost'] ?>">Decline</a>
                            <a class="btn btn-purple" href="actionAcceptProject.php?project_id=<?= $row['project_id'] ?>">Accept</a>
                          </div>
                        <?php } else if ($row['project_status'] == 'ongoing') { ?>
                          <div class="d-flex">
                            <div class="px-3 w-50">
                              <form class="d-flex" action="actionFinishProject.php?project_id=<?= $row['project_id'] ?>" method="POST" enctype="multipart/form-data">
                                <input class="form-control" type="file" name="project_deliv">
                                <input class="btn btn-purple" type="submit" value="Submit">
                              </form>
                            </div>
                            <div class="d-flex w-50">
                              <div class="w-75">
                                <p class="fw-light m-0">If you choose not to proceed with this project, please select "Decline."</p>
                              </div>
                              <div class="w-25">
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
                <!-- Modal Project End -->
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
          <!-- Layout Left End -->

          <!-- Layout Right Start -->
          <div class="shadow w-75 ms-3 rounded-3">
            <div class="p-5 text-wrap">
              <h3 class="fw-bold">ABOUT ME</h3>
              <p><?= $fyler_desc ?></p>
            </div>
            <div class="px-5">
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
              <div class="d-flex align-items-center justify-content-between">
                <h3 class="fw-bold m-0">MY PORTO</h3>
                <a class="link-purple c-scale" href="" data-bs-toggle="modal" data-bs-target="#modalInsertPorto"><i class="fa-solid fa-plus fa-xl"></i></a>
              </div>
              <!-- Modal Insert Porto Start-->
              <div class="modal fade" id="modalInsertPorto" tabindex="-1" aria-labelledby="modalInsertLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="d-flex align-items-end text-main-purple w-100 justify-content-between">
                        <h1 class="fw-bold">INSERT</h1>
                        <h3 class="fw-bold">YOUR</h3>
                        <h6 class="fw-bold">PORTO</h6>
                      </div>
                      <form action="actionInsertPorto.php?fyler_id=<?= $fyler_id ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                          <input class="form-control" type="text" name="porto_name" placeholder="Porto Name" require>
                        </div>
                        <div class="mb-3">
                          <textarea class="form-control" name="porto_desc" id="" cols="30" rows="2" placeholder="Porto Description"></textarea>
                        </div>
                        <div class="mb-3">
                          <input class="form-control" type="date" name="porto_date" placeholder="Porto Date" require>
                        </div>
                        <div class="mb-3">
                          <input class="form-control" type="file" name="porto_photo" placeholder="Porto Photo" require>
                        </div>
                        <div class="mb-3">
                          <input class="form-control btn btn-purple" type="submit" name="porto_insert" value="Insert">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal Insert Porto End -->
              <div class="row">
                <?php while ($row = mysqli_fetch_assoc($r_portos)) { ?>
                  <div class="col-lg-4 col-sm-6 d-flex flex-column align-items-center justify-content-center my-3 mx-0">
                    <div class="card card-scale rounded-3" style="height: 350px;">
                      <img src="../assets/images/portos/<?= $row['porto_photo'] ?>" class="object-fit-cover rounded-top-3 w-100" alt="" height="150px">
                      <div class="card-body">
                        <h5 class="card-tittle"><?= $row['porto_name'] ?></h5>
                        <p class="card-text"><?= $row['porto_desc'] ?></p>
                        <div>
                          <a class="btn btn-purple" href="" data-bs-toggle="modal" data-bs-target="#modalEditPorto<?= $row['porto_id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                          <a class="btn btn-transparent-purple" href="" data-bs-toggle="modal" data-bs-target="#modalDeletePorto<?= $row['porto_id'] ?>"><i class="fa-solid fa-trash"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal Edit Porto Start -->
                  <div class="modal fade" id="modalEditPorto<?= $row['porto_id'] ?>" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-body">
                          <div class="d-flex align-items-end text-main-purple w-100 justify-content-between">
                            <h1 class="fw-bold">EDIT</h1>
                            <h3 class="fw-bold">YOUR</h3>
                            <h6 class="fw-bold">PORTO</h6>
                          </div>
                          <form action="actionEditPorto.php?porto_id=<?= $row['porto_id'] ?>&porto_photo=<?= $row['porto_photo'] ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                              <input class="form-control" type="text" name="porto_name" placeholder="<?= $row['porto_name'] ?>" require>
                            </div>
                            <div class="mb-3">
                              <textarea class="form-control" name="porto_desc" id="" cols="30" rows="2" placeholder="<?= $row['porto_desc'] ?>"></textarea>
                            </div>
                            <div class="mb-3">
                              <input class="form-control" type="date" name="porto_date" placeholder="<?= $row['porto_date'] ?>" require>
                            </div>
                            <div class="mb-3">
                              <input class="form-control" type="file" name="porto_photo" require>
                            </div>
                            <div class="mb-3">
                              <input class="form-control btn btn-purple" type="submit" name="porto_edit" value="Edit">
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Edit Porto End -->

                  <!-- Modal Delete Porto Start -->
                  <div class="modal fade" id="modalDeletePorto<?= $row['porto_id'] ?>" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-body text-center">
                          <h1 class="text-secondary" style="font-size: 4em"><i class="fa-solid fa-question"></i></h1>
                          <h1 class="">Are you sure</h1>
                          <p class="text-secondary">Delete this <?= $row['porto_name'] ?> Porto</p>
                          <div>
                            <a class="btn btn-light-purple" style="width: 100px;" href="" data-bs-dismiss="modal" aria-label="Close">Cancel</a>
                            <a class="btn btn-purple" style="width: 100px;" href="actionDeletePorto.php?porto_id=<?= $row['porto_id'] ?>&porto_photo=<?= $row['porto_photo'] ?>">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Delete Porto End -->
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- Layout Right End -->
        </div>
      </div>
    </div>
  </main>

  <?php include('../layouts/footer.php'); ?>

  <script src="../bootstrap/js/bootstrap.js"></script>
</body>

</html>