<?php
session_start();
require_once('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // Memeriksa apakah email atau username sudah terdaftar sebelumnya
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        header("location:register.php?gagal=1");
        exit();
    }
    //jika password yang diulang tidak cocok 
    elseif ($password !== $repeat_password) {
        header("location:register.php?gagal=2");
        exit();
    }
    //jika semua kondisi terpenuhi
    else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql)) {
            header("Location: register.php?success=1");
            exit(); 
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
}
?>