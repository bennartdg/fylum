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
        <h1 class="fw-bold">Register King</h1>
        <p class="text-secondary">Temukan Freelancer yang kamu butuhkan di FyLum</p>
      </div>
      <div>
        <form action="" method="post">
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
                  <textarea class="form-control" name="king_add" id="" cols="30" rows="3" placeholder="Address" required></textarea>
                </div>
              </div>
            </div>
            <div class="w-50">
              <div class="px-2">
                <div class="py-2">
                  <input class="form-control" type="text" name="king_name" placeholder="Name" require>
                </div>
                <div class="py-2">
                  <textarea class="form-control" name="king_desc" id="" cols="30" rows="3" placeholder="Yourself Description" required></textarea>
                </div>
                <div class="py-2">
                  <input class="form-control" type="file" name="king_photo" placeholder="Profile Photo" require>
                </div>
              </div>
            </div>
          </div>
          <p class="text-center mt-4">Sudah memiliki akun? <a class="text-main-purple text-decoration-none" href="login.php">Login Sekarang</a></p>
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