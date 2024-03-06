<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ta_ldkom";

// Buat koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
