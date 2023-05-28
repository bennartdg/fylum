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

<body class="bg-main-light">
  <header>
    <nav class="navbar p-0 fixed-top nav-transparent">
      <div class="container-fluid w-75 py-2">
        <a class="navbar-brand" href="">
          <img src="assets/images/icons/fylum.png" height="30px" alt="">
        </a>
        <div class="fs-5">
          <a class="link-secondary-purple mx-3" href="login.php">Login</a>
          <a class="link-purple" href="" data-bs-toggle="modal" data-bs-target="#modalRegisterPick">Register</a>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="container-fluid p-0 m-0">
      <img class="object-fit-cover p-0" src="assets/images/backgrounds/laptop.jpg" height="800px" width="100%" alt="">
      <div class="position-absolute w-25 top-50 end-0">
        <h1 class="fw-bold text-main-purple">START YOUR JOURNEY TODAY.</h1>
        <div class="">
          <a class="btn btn-transparent-purple m-2" href="registerFyler.php">JOIN AS FYLER</a>
          <a class="btn btn-purple m-2" href="registerKing.php">RECRUIT A FYLER</a>
        </div>
      </div>
      <section class="container w-75 d-flex justify-content-center position-absolute start-50 translate-middle mb-1">
        <div class="row">
          <div class="c-scale col-lg-4 col-sm-4 p-2">
            <div class="d-flex flex-row bg-light shadow text-dark align-items-center text-center rounded-3">
              <div class="w-50">
                <img class="rounded-start-3" src="assets/images/contents/graphicdesigner.jpg" alt="" width="100%">
              </div>
              <div class="w-50">
                <h6>Graphic & Design</h6>
                <p style="font-size: small;">UI&UX Design | Landing Page Design | Icon Design</p>
              </div>
            </div>
          </div>
          <div class="c-scale col-lg-4 col-sm-4 p-2">
            <div class="d-flex flex-row bg-light shadow text-dark align-items-center text-center rounded-3">
              <div class="w-50">
                <img class="rounded-start-3" src="assets/images/contents/architecture.jpg" alt="" width="100%">
              </div>
              <div class="w-50">
                <h6>Architecture Designer</h6>
                <p style="font-size: small;">Architecture & Interior Design | Landscape Design | Building Engineering
                </p>
              </div>
            </div>
          </div>

          <div class="c-scale col-lg-4 col-sm-4 p-2">
            <div class="d-flex flex-row bg-light shadow text-dark align-items-center text-center rounded-3">
              <div class="w-50">
                <img class="rounded-start-3" src="assets/images/contents/photographer.jpg" width="100%">
              </div>
              <div class="w-50">
                <h6>Photographer</h6>
                <p style="font-size: small;">Portrait Photographer | Event Photographers | Real Estate Photographers</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <!-- about::start -->
    <div class="container-sm mt-5">
      <section class='row align-content-center justify-content-center gy-5 my-n5' style="margin-top: 7.4em;">
        <h2 class='text-center my-5 d-block fw-bold fs-1 text-main-purple fw-bold'>ABOUT</h2>
        <div class="row gy-3">
          <div class="row">
            <div class="shadow p-5 col-5 rounded-3 mb-5">
              <h3 class="text-secondary-purple fw-light">
                Ancient | Admin
              </h3>
              <p class="">
                Ancient/admin is a person or user who manages all transactions and data in a Fylum
              </p>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="shadow p-5 col-5 text-end rounded-3 mb-5">
              <h3 class="text-secondary-purple fw-light">
                King | Client
              </h3>
              <p class="">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit eum ad, exercitationem, quo quod quos ab
                laboriosam, non natus nesciunt molestiae nam iusto odit deleniti totam vel tempora minima amet.
              </p>
            </div>
          </div>
          <div class="row">
            <div class="shadow p-5 col-5 rounded-3 mb-5">
              <h3 class="text-secondary-purple fw-light">
                Fyler | Freelancer
              </h3>
              <p class="">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit eum ad, exercitationem, quo quod quos ab
                laboriosam, non natus nesciunt molestiae nam iusto odit deleniti totam vel tempora minima amet.
              </p>
            </div>
          </div>
        </div>
      </section>
      <!-- about::end -->
      <!-- contact::start -->
      <section class="shadow p-1 rounded-3 mt-3">
        <h2 class='text-center my-5 d-block fw-bold fs-1 text-main-purple fw-bold'>OUR TEAM</h2>
        <div class="row">
          <div class="text-center col-4">
            <img src="assets/images/contact/ben.jpg" class="rounded-circle object-fit-cover" height="200px" width="200px" alt="">
            <p class="m-0 p-1">Bennart Dem Gunawan</p>
            <p>162021021</p>
          </div>
          <div class="text-center col-4">
            <img src="assets/images/contact/atha.png" class="rounded-circle object-fit-cover" height="200px" width="200px" alt="">
            <p class="m-0 p-1">Hasnaura Atha</p>
            <p>162021028</p>
          </div>
          <div class="text-center col-4">
            <img src="assets/images/contact/haikal.jpg" class="rounded-circle object-fit-cover" height="200px" width="200px" alt="">
            <p class="m-0 p-1">Muhammad Haikal</p>
            <p>162021029</p>
          </div>
        </div>
      </section>
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
  <footer class="">
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
              <img src="assets/images/icons/fylum_light.png" alt="" height="40px">
            </a>
          </div>
        </div>
        <div class="bg-secondary-purple text-center p-2">
          <p class="text-uppercase fw-semibold m-0" style="font-size: small;">Pleasure in the job puts perfection in the
            work | Aristotle</p>
          <p class="m-0" style="font-size: x-small;">&copy;2023 | FYLUM COMPANY | ALL RIGHT RESERVED</p>
        </div>
      </div>
    </div>
  </footer>

  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="bootstrap/js/script.js"></script>
</body>

</html>