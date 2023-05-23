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
        <p class="text-secondary">Tingkatkan personal branding dan temukan projek terbaikmu</p>
      </div>
      <form action="" method="post">
        <div>
          <input class="form-control my-3" type="text" name="account_email" placeholder="Email" require>
        </div>
        <div>
          <input class="form-control my-3" type="password" name="account_password" placeholder="Password" require>
        </div>
        <div>
          <input type="submit" class="form-control btn btn-purple my-3" value="Login">
        </div>
      </form>
      <p class="text-center">Baru di Fylum? <a class="text-main-purple text-decoration-none" href="" data-bs-toggle="modal" data-bs-target="#modalRegisterPick">Register Sekarang</a></p>
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
          <h1 class="">Register Sebagai</h1>
          <p class="text-secondary">Pilih King untuk Rekrut Freelancer, Fyler sebagai Freelancer</p>
          <div>
            <a class="btn btn-purple" href="registerKing.php">King</a>
            <a class="btn btn-purple" href="registerFyler.php">Fyler</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Register Pick End -->

  <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>