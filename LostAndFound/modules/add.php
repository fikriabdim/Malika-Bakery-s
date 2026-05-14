<?php
session_start();
include "../config/database.php";
if(isset($_POST['submit'])) {
    $uid = $_SESSION['user_id'];
    $judul = $_POST['judul']; $kat = $_POST['kategori']; $lok = $_POST['lokasi'];
    $foto = time() . "_" . $_FILES['foto']['name'];
    if(move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/".$foto)) {
        mysqli_query($conn, "INSERT INTO laporan (user_id, judul, kategori, foto, lokasi_ditemukan, tanggal) 
                             VALUES ('$uid', '$judul', '$kat', '$foto', '$lok', NOW())");
        header("Location: ../index.php");
    }
}
include "../includes/header.php";
?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="judul" placeholder="Nama Barang" required><br>
    <select name="kategori"><option value="Barang">Barang</option><option value="Dokumen">Dokumen</option></select><br>
    <input type="text" name="lokasi" placeholder="Lokasi" required><br>
    <input type="file" name="foto" required><br>
    <button type="submit" name="submit">Kirim Laporan</button>
</form>