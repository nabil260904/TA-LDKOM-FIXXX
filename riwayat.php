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
              echo  '</td>';
              echo "</tr>";
          }
        } else {
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
