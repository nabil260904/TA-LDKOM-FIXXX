<?php
include 'koneksi.php';
// File process_exchange.php

session_start(); // Pastikan sesi dimulai di awal file

// Pastikan pengguna telah login sebelumnya
if (!isset($_SESSION["email"])) {
    // Redirect ke halaman login atau tindakan lain yang sesuai
    exit("Anda belum login");
}

// Tangkap data dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currency = $_POST["currency"];
    $amount = $_POST["amount"];
    $total = $_POST["total"];

    // Mengambil user_id berdasarkan alamat email
    $email = $_SESSION["email"];
    $query = "SELECT id FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];

        // Masukkan data ke dalam tabel penukaran
        $sql = "INSERT INTO penukaran (currency, amount, total, user_id) VALUES ('$currency', '$amount', '$total', '$user_id')";

        if (mysqli_query($conn, $sql)) {
            header("Location: index.php?success=1");
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User tidak ditemukan";
    }
}
?>
