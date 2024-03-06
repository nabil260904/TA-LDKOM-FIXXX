<?php 

    include 'koneksi.php';
    $gagal = isset($_GET['gagal']) ? $_GET['gagal'] : '';
    $success = isset($_GET['success']) ? $_GET['success'] : '';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Assets/styles/auth.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="path/to/bootstrap.bundle.min.js"></script>
    <title>Sign Up</title>
    <link rel="shortcut icon" type="x-icon" href="Assets/image/logo.png">

  </head>
  <body style="background-image: url(Assets/image/bg.jpg); background-size: cover;">
    <!----------------------- Main Container -------------------------->

    <div
      class="container d-flex justify-content-center align-items-center min-vh-100"
    >
      <!----------------------- Login Container -------------------------->

      <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <!--------------------------- Left Box ----------------------------->

        <div
          class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
          style="background-image: linear-gradient(to right, #ef1170, #fe6506)"
        >
          <div class="featured-image mb-3">
            <img
              src="Assets/image/logo.png"
              class="img-fluid"
              style="width: 300px"
            />
          </div>
          <p
            class="text-white fs-2"
            style="
              font-family: 'Courier New', Courier, monospace;
              font-weight: 600;
            "
          >
            Money Changer
          </p>
          <small
            class="text-white text-wrap text-center"
            style="width: 17rem; font-family: 'Courier New', Courier, monospace"
            >Penukaran Mata Uang yang Cepat, Aman, dan Efisien</small
          >
        </div>

        <!-------------------- ------ Right Box ---------------------------->

        <div class="col-md-6 right-box">
          <div class="row align-items-center">
            <div class="header-text mb-4">
              <h2>Selamat Datang</h2>
              <p>Jadilah bagian dari MC</p>
            </div>
            
            <form action="daftar.php" method="post">
            
          

            <?php if($gagal == 1) {?>
            <div
            class="alert alert-warning alert-dismissible fade show"
            role="alert" id="close"
          >
          <strong>Username Sudah Digunakan!</strong> Pendaftaran Gagal.
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="alert"
              aria-label="Close"
            ></button>
          </div>

          <?php 
          } elseif ($gagal == '2') { 
            ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Password tidak sesuai!</strong> Pendaftaran Gagal.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="close"></button>
          </div>
          <?php } ?>

            <div class="input-group mb-3">
            <input
                type="text"
                id="username"
                name="username"
                required
                class="form-control form-control-lg bg-light fs-6"
                placeholder="Username"
              />
            </div>
            <div class="input-group mb-3">
              
              <input
                type="email"
                class="form-control form-control-lg bg-light fs-6"
                placeholder="Email address"
                id="email"
                name="email"
                required
              />
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                class="form-control form-control-lg bg-light fs-6"
                placeholder="Password"
                id="password"
                name="password"
              />
            </div>
            <div class="input-group mb-1">
              <input
                type="password"
                class="form-control form-control-lg bg-light fs-6"
                placeholder="Repeat Password"
                id="Repeat"
                name="repeat_password"
                required
              />
            </div>
           
            <div class="input-group mb-3">
              <button class="btn btn-lg btn-primary w-100 fs-6 mt-4" type="submit" style="
                    background-image: linear-gradient(
                      to right,
                      #519b23,
                      #91d044
                    );
                    color: #fff;
                    border: none;
                  ">Daftar</button>
            </div>
            <?php if($success == 1) {?>
              <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran Berhasil',
                    text: 'Anda berhasil mendaftar. Silakan masuk untuk melanjutkan.'
                }).then(function() {
                    window.location.href = 'login.php';
                });
              </script>
              <?php } ?>
            </form>
            <div class="row">
              <small
                >Sudah Punya Akun?
                <a href="login.php" style="color: #519b23">Masuk</a></small
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    document.getElementById('close').addEventListener('click', function() {
        window.location.href = 'register.php';
    });
</script>

  </body>
</html>
>