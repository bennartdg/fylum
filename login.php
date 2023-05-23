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
  <script src="https://kit.fontawesome.com/61f8d3e11d.js" crossorigin="anonymous"></script>
  <title>Login</title>
</head>

<body class="bg-main-purple">
  <div class="position-absolute bottom-0 start-50 translate-middle">
    <a href="">
      <img src="assets/images/icons/fylum.png" alt="" height="40px">
    </a>
  </div>
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
          <input type="submit" class="form-control btn btn-purple my-3">
        </div>
      </form>
      <p class="text-center">New to Fylum? <a class="text-main-purple text-decoration-none" href="">Join Now</a></p>
    </div>
  </main>

  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>