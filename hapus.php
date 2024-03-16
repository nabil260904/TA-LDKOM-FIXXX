<?php
session_start();
include 'koneksi.php';

if(isset($_POST['id_penukaran'])) {
    $id_penukaran = $_POST['id_penukaran'];

    // Lakukan query untuk menghapus baris penukaran berdasarkan ID
    $delete_query = "DELETE FROM penukaran WHERE id = $id_penukaran";
    $delete_result = $conn->query($delete_query);

    if($delete_result) {
        // Tulis pesan log
        file_put_contents('log.txt', 'ID Penukaran yang dihapus: ' . $id_penukaran . PHP_EOL, FILE_APPEND);
        echo "Data penukaran dengan ID $id_penukaran telah dihapus.";
    } else {
        echo "Gagal menghapus data";
    }
}

