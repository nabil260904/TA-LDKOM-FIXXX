<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Riwayat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="Assets/styles/user.css" />
    <link rel="stylesheet" href="Assets/styles/bg.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" type="x-icon" href="Assets/image/logo.png">

  </head>
  <body>
      <div class="bg">
       
        <table class="table-on-image">
        <thead>
    <tr>
        <th>Mata Uang</th>
        <th>Nominal</th>
        <th>Total Bayar</th>
        <th>Status</th>
        <th>Waktu Penukaran</th>
        <th>Batas Waktu Penukaran</th>
        <th>Aksi</th>
       
    </tr>
</thead>
<tbody>
    <?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: login.php"); 
        exit();
    }

    $email = $_SESSION['email']; 

    include 'koneksi.php';

    // Mendapatkan user_id dari basis data
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $_SESSION['user_id'] = $user_id; // Menyimpan user_id dalam session

        // Setelah mendapatkan user_id, sekarang kita dapat menampilkan data penukaran yang terkait dengan user_id tersebut
        $query_penukaran = "SELECT id, currency, amount, total, status, waktu_penukaran 
                            FROM penukaran 
                            WHERE user_id = $user_id";

        $result_penukaran = $conn->query($query_penukaran);

        if ($result_penukaran->num_rows > 0) {
          // Output data dari setiap baris
          while($row_penukaran = $result_penukaran->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row_penukaran["currency"] . "</td>";
              echo "<td>" . $row_penukaran["amount"] . "</td>";
              echo "<td>" . $row_penukaran["total"] . "</td>";
              echo "<td>" . $row_penukaran["status"] ."</td>";
              echo "<td>" . $row_penukaran["waktu_penukaran"] . "</td>";
      
              // Tambahkan pengecekan status sebelum menampilkan countdown
              if ($row_penukaran["status"] !== "selesai") {
                  $waktu_sekarang = time(); // Waktu saat ini dalam detik
                  $batas_waktu = strtotime($row_penukaran["waktu_penukaran"]) + (3 * 3600); // Tambahkan 3 jam ke waktu penukaran
                  $selisih_waktu = $batas_waktu - $waktu_sekarang; // Selisih waktu dalam detik
      
                  echo "<td id='countdown_" . $row_penukaran["id"] . "'></td>"; // Tampilkan countdown
                  // Logika untuk menghapus data jika waktu habis
                  if ($selisih_waktu <= 0) {
                      // Hapus data dari database
                      $id_penukaran = $row_penukaran["id"];
                      $query_hapus = "DELETE FROM penukaran WHERE id = $id_penukaran";
                      $conn->query($query_hapus);
                  } else {
                      // Script JavaScript untuk countdown timer
                      echo "<script>
                      var countdown_" . $row_penukaran["id"] . " = $selisih_waktu;
                      var x_" . $row_penukaran["id"] . " = setInterval(function() {
                          countdown_" . $row_penukaran["id"] . "--;
                          var hours = Math.floor(countdown_" . $row_penukaran["id"] . " / 3600);
                          var minutes = Math.floor((countdown_" . $row_penukaran["id"] . " % 3600) / 60);
                          var seconds = countdown_" . $row_penukaran["id"] . " % 60;
                          var display = hours + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
                          document.getElementById('countdown_" . $row_penukaran["id"] . "').innerHTML = display;

                          if (countdown_" . $row_penukaran["id"] . " <= 0) {
                              clearInterval(x_" . $row_penukaran["id"] . ");
                              document.getElementById('countdown_" . $row_penukaran["id"] . "').innerHTML = 'Waktu Habis';

                              // Hapus data dari database
                              var xhr = new XMLHttpRequest();
                              xhr.open('POST', 'hapus.php', true);
                              xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                              xhr.onreadystatechange = function() {
                                  if (xhr.readyState == 4 && xhr.status == 200) {
                                      console.log(xhr.responseText); // Response dari server (optional)
                                  }
                              };
                              xhr.send('id_penukaran=" . $row_penukaran["id"] . "'); // Kirim ID penukaran yang akan dihapus
                          }
                      }, 1000);
                      </script>";

                  }
              } else {
                  echo "<td></td>"; // Tampilkan kolom kosong jika status sudah selesai
              }
      
              echo '<td>
                  <form method="post" action="hapus.php" >'; // Form untuk menangani penghapusan
              echo '<input type="hidden" name="id_penukaran" value="' . $row_penukaran["id"] . '">'; // ID penukaran yang akan dihapus
      
              // Periksa status penukaran
              if ($row_penukaran["status"] === "selesai") {
                  echo '<button type="submit" name="deleteBtn" id="deleteBtn" onclick="return false;" disabled>Batal</button>';
              } else {
                  echo '<button type="submit" name="deleteBtn" id="deleteBtn" onclick="return confirmDelete();">Batal</button>';
              }
      
              echo '</form>';  
              echo '</td>';
              echo "</tr>";
          }
      }
       else {
            echo "<tr><td colspan='6'>Tidak ada data penukaran</td></tr>";
        }
    } else {
        echo "<tr><td colspan='6'>Sesi user tidak valid</td></tr>"; // Contoh pesan error jika sesi tidak valid
    }
    ?>
</tbody>

        </table>
      </div>
   

    <nav class="navbar">
      <div class="navbar__logo">
        <a href="index.php"><img src="Assets/image/logo.png" alt="Logo" /></a>
      </div>
      <div class="navbar_menu">
        <a href="index.php">Tukar Sekarang</a>
        <a href="riwayat.php">Riwayat</a>
        <a href="logout.php">Logout</a>
      </div>
    </nav>
    <script>
    function confirmDelete() {
        return confirm("Apakah Anda yakin ingin membatalkan penukaran?");
    }
    
</script>




  </body>
</html>
