<?php
session_start();
require_once('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email == 'admin' && $password == 'admin'){
      $_SESSION['admin_logged_in'] = true;
      header("Location: admin.php");
      exit();
    }

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $email;
            header("Location: index.php"); 
            exit();
        } else {
            // wrong password
            header("location:login.php?gagal=1");
        exit();
        }
    } else {
        // user not found
        echo "<script>alert('User tidak ditemukan.')</script>";
        header("location:login.php?gagal=2");
        exit();
    }
}


?>