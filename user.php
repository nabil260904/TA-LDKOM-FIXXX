
<?php
include 'koneksi.php';
session_start();

// Periksa apakah admin telah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Jika tidak, arahkan kembali ke halaman login atau halaman lain
    header("Location: login.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin-users</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assets/styles/adm.css" />
    <link rel="shortcut icon" type="x-icon" href="Assets/image/logo.png">

  </head>

  <body>
    <div class="wrapper">
      <aside id="sidebar">
        <div class="d-flex">
          <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
          </button>
          <div class="sidebar-logo">
            <a href="#">MC</a>
          </div>
        </div>
        <ul class="sidebar-nav">
          
          <li class="sidebar-item " >
            <a href="admin.php" class="sidebar-link">
              <i class="lni lni-agenda"></i>
              <span>Riwayat</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target="#auth"
              aria-expanded="false"
              aria-controls="auth"
            >
              <i class="lni lni-protection"></i>
              <span>Autentikasi</span>
            </a>
            <ul
              id="auth"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Users</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Admin</a>
              </li>
            </ul>
          </li>
         
        <div class="sidebar-footer">
          <a href="logout.php" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
          </a>
        </div>
      </aside>
      <div class="main p-3">
        <div class="text-center">
          <h1>Admin</h1>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-md-12">
            <section id="tabel1">
              <div class="table-responsive">
                <h2>Users</h2>
                <table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>
        <?php
      

        // Query untuk mengambil data dari tabel users
        $sql = "SELECT id, username, email, password FROM users";
        $result = $conn->query($sql);

        // Memeriksa apakah hasil query tidak kosong
        if ($result->num_rows > 0) {
            // Menampilkan data dari setiap baris hasil query
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["username"]."</td>
                        <td>".$row["email"]."</td>
                        <td>".$row["password"]."</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data user</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>


            </div>
          </div>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>
    <script>
      const hamBurger = document.querySelector(".toggle-btn");

      hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
      });
    </script>
  </body>
</html>
