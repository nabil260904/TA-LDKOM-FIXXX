<?php 

    include 'koneksi.php';
    $gagal = isset($_GET['gagal']) ? $_GET['gagal'] : '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assets/styles/auth.css" />
    <link rel="shortcut icon" type="x-icon" href="Assets/image/logo.png">

    <title>Sign In</title>
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
              style="width: 250px"
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
              <h2>Halo..</h2>
              <p>Kami senang Anda kembali.</p>
            </div>
            <form action="masuk.php" method="post">
            <?php if($gagal == 1) {?>
            <div
            class="alert alert-warning alert-dismissible fade show"
            role="alert" id="close"
          >
          <strong>Password salah!</strong> login gagal.
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
              <strong>User tidak ditemukan!</strong> silakan daftar terlebih dahulu.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="close"></button>
          </div>
          <?php } ?>
              <div class="input-group mb-3">
                <input
                  type="text"
                  class="form-control form-control-lg bg-light fs-6"
                  placeholder="Email"
                  id="email"
                  name="email"
                />
              </div>
              <div class="input-group mb-1">
                <input
                  type="password"
                  class="form-control form-control-lg bg-light fs-6"
                  placeholder="Password"
                  id="password"
                  name="password"
                />
              </div>
            
              <div class="input-group mb-3">
                <button
                  class="btn btn-lg w-100 fs-6 mt-4"
                  class="submit"
                  style="
                    background-image: linear-gradient(
                      to right,
                      #519b23,
                      #91d044
                    );
                    color: #fff;
                    border: none;
                  "
                >
                  Masuk
                </button>
              </div>
            </form>

            <div class="row">
              <small
                >Tidak Punya Akun?
                <a href="register.php" style="color: #519b23">Daftar</a></small
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
    document.getElementById('close').addEventListener('click', function() {
        window.location.href = 'login.php';
    });
</script>
  </body>
</html>
