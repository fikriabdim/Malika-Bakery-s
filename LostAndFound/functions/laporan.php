<?php
include "config/database.php";

function getAllLaporan() {
    global $conn;
    $query = "SELECT * FROM laporan ORDER BY tanggal DESC";
    return mysqli_query($conn, $query);
}

function tambahLaporan($data, $file) {
    global $conn;
    $judul = htmlspecialchars($data['judul']);
    $kategori = $data['kategori'];
    $deskripsi = $data['deskripsi'];
    $lokasi = $data['lokasi'];
    $tanggal = $data['tanggal'];
    $tipe = $data['tipe'];
    $user_id = $_SESSION['user_id'];

    // Logika upload foto singkat
    $foto = $file['name'];
    move_uploaded_file($file['tmp_name'], "assets/img/" . $foto);

    $query = "INSERT INTO laporan (user_id, tipe, judul, kategori, deskripsi, foto, lokasi, tanggal) 
              VALUES ('$user_id', '$tipe', '$judul', '$kategori', '$deskripsi', '$foto', '$lokasi', '$tanggal')";
    
    return mysqli_query($conn, $query);
}
?>