<?php
include "../config/database.php";
if (isset($_POST['register'])) {
    $nim = mysqli_real_escape_string($conn, $_POST['nim_nip']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kontak = mysqli_real_escape_string($conn, $_POST['kontak']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (nim_nip, nama, kontak, username, password) VALUES ('$nim', '$nama', '$kontak', '$user', '$pass')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Berhasil Daftar! Silakan Login'); window.location='login.php';</script>";
    }
}
?>
<div style="max-width: 400px; margin: 100px auto; font-family: sans-serif;">
    <h2>Daftar Akun Baru</h2>
    <form method="POST">
        <input type="text" name="nim_nip" placeholder="NIM/NIP" required style="width:100%; margin-bottom:10px;"><br>
        <input type="text" name="nama" placeholder="Nama Lengkap" required style="width:100%; margin-bottom:10px;"><br>
        <input type="text" name="kontak" placeholder="WhatsApp (08xx)" required style="width:100%; margin-bottom:10px;"><br>
        <input type="text" name="username" placeholder="Username" required style="width:100%; margin-bottom:10px;"><br>
        <input type="password" name="password" placeholder="Password" required style="width:100%; margin-bottom:10px;"><br>
        <button type="submit" name="register" style="width:100%; padding:10px; background:blue; color:white; border:none;">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>