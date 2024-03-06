<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php"); 
    exit();
}
$success = isset($_GET['success']) ? $_GET['success'] : '';

$email = $_SESSION['email']; 
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="Assets/styles/user.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" type="x-icon" href="Assets/image/logo.png">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </head>
  <body>
    <header>
      <div class="jumbotron">
        <div class="layer">
          <div class="jumbotron__content">
            <h1>Selamat Datang di MC</h1>
            <h1><?php echo $email; ?></h1>
            <p>Penukaran Mata Uang yang Cepat, Aman, dan Efisien</p>
          </div>
        </div>
      </div>
      <nav class="navbar">
        <div class="navbar__logo">
          <a href="#"><img src="Assets/image/logo.png" alt="Logo" /></a>
        </div>
        <div class="navbar_menu">
          <a href="#tukar">Tukar Sekarang</a>
          <a href="riwayat.php">Riwayat</a>
          <a href="logout.php">Logout</a>
        </div>
      </nav>
    </header>
    <div class="main-content">
      <h1>Mata Uang Tersedia</h1>
      <div class="card-container">
        <div class="card">
          <img src="Assets/image/united-states.png" alt="" />
          <div class="desk">
            <p>USA</p>
          </div>
        </div>
        <div class="card">
          <img src="Assets/image/united-kingdom.png" alt="" />
          <div class="desk">
            <p>UK</p>
          </div>
        </div>
        <div class="card">
          <img src="Assets/image/saudi-arabia.png" alt="" />
          <div class="desk">
            <p>Arab Saudi</p>
          </div>
        </div>
        <div class="card">
          <img src="Assets/image/malaysia.png" alt="" />
          <div class="desk">
            <p>Malaysia</p>
          </div>
        </div>
        <div class="card">
          <img src="Assets/image/japan.png" alt="" />
          <div class="desk">
            <p>Jepang</p>
          </div>
        </div>
      </div>
      <section id="tukar">
        <div class="penukaran">
          <form id="exchangeForm" action="penukaran.php" method="post" class="form">
            <label for="currency">Mata Uang Negara Tujuan:</label>
            <select id="currency" name="currency" >
              <option value="" disabled selected hidden>Pilih Mata Uang</option>
              <option value="USD">Amerika (USD)</option>
              <option value="UK">Inggris (UK)</option>
              <option value="Malaysia">Malaysia (MYR)</option>
              <option value="Jepang">Jepang (JPY)</option>
              <option value="Saudi">Arab Saudi (SAR)</option>
            </select>
            <br />
            <label for="amount">Pilih Nominal:</label>
            <select id="amount" name="amount">
              <!-- Pilihan untuk USD -->
              <optgroup label="Amerika (USD)">
                <option value="" disabled selected hidden>Nominal</option>
                <option value="1000">USD 1000</option>
                <option value="3000">USD 3000</option>
                <option value="5000">USD 5000</option>
              </optgroup>
              <!-- Pilihan untuk UK -->
              <optgroup label="Inggris (UK)">
                <option value="800">£800</option>
                <option value="2400">£2400</option>
                <option value="4800">£4800</option>
              </optgroup>
              <!-- Pilihan untuk Malaysia -->
              <optgroup label="Malaysia (MYR)">
                <option value="4000">4000 RM</option>
                <option value="8000">8000 RM</option>
                <option value="16000">16000 RM</option>
              </optgroup>
              <!-- Pilihan untuk Jepang -->
              <optgroup label="Jepang (JPY)">
                <option value="200000">¥200.000</option>
                <option value="500000">¥500.000</option>
                <option value="700000">¥700.000</option>
              </optgroup>
              <!-- Pilihan untuk Arab Saudi -->
              <optgroup label="Arab Saudi (SAR)">
                <option value="4000">4000 Riyal</option>
                <option value="8000">8000 Riyal</option>
                <option value="16000">16000 Riyal</option>
              </optgroup>
            </select>
            <br />
            <button type="button" onclick="hitungTotal()">Cek</button>
            <label for="total">Total yang harus dibayarkan (IDR):</label>
            <br />
            <input type="text" id="total" name="total" required     />
            <button type="submit" name="submit" id="konfirmasi" >
              konfirmasi
            </button>
            <?php if($success == 1) { ?>
            <script>
                Swal.fire({
                  title: "Selamat!",
                  text: "Penukaran Berhasil!",
                  icon: "success"
                }).then(function() {
                    window.location.href = 'riwayat.php'
                });
            </script>
            <?php } ?>
         

          </form>
        </div>
      </section>
    </div>
    <footer>
      <div class="about">
        <img src="Assets/image/logo.png" alt="" />
        <p>
          Aplikasi Money Changer kami memberikan solusi instan untuk pertukaran
          mata uang dengan antarmuka intuitif, fitur kalkulator konversi, dan
          riwayat transaksi. Pengalaman bertransaksi yang efisien didukung oleh
          keamanan tinggi dan layanan yang handal
        </p>
        <div class="sosmed">
          <div class="rounded">
            <a href="https://github.com/nabil260904" target="_blank">
              <i class="fab fa-github"></i
            ></a>
          </div>
          <div class="rounded">
            <a href="https://wa.me/6281275584870" target="_blank"
              ><i class="fab fa-whatsapp"></i
            ></a>
          </div>
          <div class="rounded">
            <a href="https://www.instagram.com/nabilrizkinavisa" target="_blank"
              ><i class="fab fa-instagram"></i
            ></a>
          </div>
        </div>
      </div>
      <div class="kelebihan">
        <h3>Keunggulan</h3>
        <ul>
          <li>Cepat</li>
          <li>Mudah</li>
          <li>Praktis</li>
          <li>Hemat Waktu</li>
          <li>Aman</li>
        </ul>
      </div>
    </footer>
    <div class="copy">
      <p>Copyright &copy NRN. All right reserved</p>
    </div>
    <script>
      // Fungsi untuk menghitung total yang harus dibayarkan
      function hitungTotal() {
        // Mendapatkan nilai negara dan nominal yang dipilih
        var currency = document.getElementById("currency").value;
        var amount = document.getElementById("amount").value;

        // Objek yang berisi harga tukar untuk setiap negara
        var exchangeRates = {
          USD: { 1000:  15800000, 3000: 47200000, 5000: 78600000 },
          UK: { 800: 15900000, 2400: 47700000, 4800: 95300000 },
          Malaysia: { 4000: 13300000, 8000: 26500000, 16000: 53000000 },
          Jepang: { 200000: 21000000, 500000: 52300000, 700000: 73400000 },
          Saudi: { 4000: 17000000, 8000: 33600000, 16000: 67100000 },
        };

        // Memeriksa apakah negara dan nominal yang dipilih valid
        if (
          exchangeRates.hasOwnProperty(currency) &&
          exchangeRates[currency].hasOwnProperty(amount)
        ) {
          // Menghitung total yang harus dibayarkan
          var totalRupiah = exchangeRates[currency][amount];
          // Mengupdate nilai input dengan id "total"
          document.getElementById("total").value =
            totalRupiah.toLocaleString("id-ID"); // Menampilkan dengan format angka lokal
        } else {
          // Menampilkan pesan jika pilihan tidak valid
          document.getElementById("total").value = "Pilihan tidak valid.";
        }
      }

      // Menambahkan event listener untuk tombol "Hitung"
      document
        .getElementById("exchangeForm")
        .addEventListener("konfirmasi", function (event) {
          // Menghentikan pengiriman form
          event.preventDefault();
          // Memanggil fungsi hitungTotal
          hitungTotal();
        });
       

        
    </script>
    <script src="Assets/js/script.js"></script>
  </body>
</html>
