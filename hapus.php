<?php
session_start();
include 'koneksi.php';

if(isset($_POST['id_penukaran'])) {
    $id_penukaran = $_POST['id_penukaran'];

    // Lakukan query untuk menghapus baris penukaran berdasarkan ID
    $delete_query = "DELETE FROM penukaran WHERE id = $id_penukaran";
    $delete_result = $conn->query($delete_query);

    if($delete_result) {
        header("Location: riwayat.php");
        exit(); 
    } else {
        echo "Gagal menghapus data";
    }
}
?>
