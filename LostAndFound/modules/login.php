<?php
session_start();
include "../config/database.php";
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $res = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user'");
    if ($row = mysqli_fetch_assoc($res)) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            header("Location: ../index.php");
            exit;
        }
    }
    echo "<script>alert('Login Gagal!');</script>";
}
?>
<div style="max-width: 400px; margin: 100px auto; font-family: sans-serif; text-align: center;">
    <h2>Login Sistem</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required style="width:100%; margin-bottom:10px; padding:8px;"><br>
        <input type="password" name="password" placeholder="Password" required style="width:100%; margin-bottom:10px; padding:8px;"><br>
        <button type="submit" name="login" style="width:100%; padding:10px; background:green; color:white; border:none;">Masuk</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar Terlebih Dahulu</a></p>
</div>