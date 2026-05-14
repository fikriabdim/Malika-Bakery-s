<?php
session_start();
if(!isset($_SESSION['login'])) header("Location: login.php");
include "../config/database.php";

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT laporan.*, users.nama, users.kontak FROM laporan 
                            JOIN users ON laporan.user_id = users.id WHERE laporan.id = $id");
$d = mysqli_fetch_assoc($res);

if(isset($_POST['set_found'])) {
    mysqli_query($conn, "UPDATE laporan SET status = 'barang sudah ditemukan' WHERE id = $id");
    header("Location: detail.php?id=$id");
}

include "../includes/header.php";
?>
<h2>Detail Catatan Barang #<?= $d['id'] ?></h2>
<div style="display:flex; gap: 30px;">
    <img src="../assets/img/<?= $d['foto'] ?>" width="400" style="border-radius:10px;">
    <div>
        <h3><?= $d['judul'] ?></h3>
        <p><strong>Lokasi:</strong> <?= $d['lokasi_ditemukan'] ?></p>
        <p><strong>Keterangan:</strong> <?= $d['deskripsi'] ?></p>
        <p><strong>Status:</strong> <span style="padding:5px; background:yellow;"><?= strtoupper($d['status']) ?></span></p>
        <hr>
        <h4>Informasi Pengunggah</h4>
        <p><strong>Nama:</strong> <?= $d['nama'] ?></p>
        <p><strong>Kontak:</strong> <a href="https://wa.me/<?= $d['kontak'] ?>" target="_blank" style="color:green; font-weight:bold;"><?= $d['kontak'] ?> (Hubungi via WhatsApp)</a></p>
        
        <?php if($d['user_id'] == $_SESSION['user_id'] && $d['status'] == 'aktif'): ?>
            <form method="POST">
                <button type="submit" name="set_found" style="padding:10px; background:blue; color:white; border:none; cursor:pointer;">
                    Tandai: Barang Sudah Ditemukan
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>
<br><a href="../index.php"> Kembali ke Dashboard</a>
<?php include "../includes/footer.php"; ?>