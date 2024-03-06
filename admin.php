
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
    <title>Admin</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="Assets/styles/adm.css" />
    <link rel="shortcut icon" type="x-icon" href="Assets/image/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <a href="#" class="sidebar-link">
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
                <a href="user.php" class="sidebar-link">Users</a>
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
                <h2>Penukaran</h2>
                <table class="table">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Mata Uang</th>
                      <th>Nominal</th>
                      <th>Total Bayar</th>
                      <th>Status</th>
                      <th>waktu_penukaran</th>
                      <th>user_id</th>
                    </tr>
                  </thead>
                <tbody>
                <?php
              // Form handling
              if(isset($_POST['submit'])) {
                  $id = $_POST['id'];
                  $new_status = $_POST['status_' . $id]; // Ambil nilai status baru

                  // Update status di database
                  $update_query = "UPDATE penukaran SET status='$new_status' WHERE id=$id";
                  $update_result = $conn->query($update_query);
              }

              // Query untuk mengambil data dari tabel penukaran
              $query = "SELECT * FROM penukaran";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                  // Output data dari setiap baris
                  while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["id"] . "</td>";
                      echo "<td>" . $row["currency"] . "</td>";
                      echo "<td>" . $row["amount"] . "</td>";
                      echo "<td>" . $row["total"] . "</td>";
                      echo "<td>";
                      // Dropdown untuk status
                      echo "<form method='post'>";
                      echo "<select name='status_" . $row["id"] . "' " . ($row["status"] == "selesai" ? "disabled" : "") . ">";
                      echo "<option value='menunggu'" . ($row["status"] == "menunggu" ? " selected" : "") . ">Menunggu</option>";
                      echo "<option value='selesai'" . ($row["status"] == "selesai" ? " selected disabled" : "") . ">Selesai</option>";
                      echo "</select>";
                      echo "<input type='hidden' name='id' value='" . $row["id"] . "'>"; // ID yang tersembunyi untuk identifikasi baris
                      echo "<button type='submit'   name='submit' " . ($row["status"] == "selesai" ? "disabled" : "") . ">Simpan</button>";
                      echo "</form>";
                      echo "</td>";
                      echo "<td>" . $row["waktu_penukaran"] . "</td>";
                      echo "<td><a href='user.php?id=" . $row["user_id"] . "'>" . $row["user_id"] . "</a></td>";

                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='7'>Tidak ada data penukaran</td></tr>";
              }
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
