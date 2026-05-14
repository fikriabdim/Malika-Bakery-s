<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "lost_and_found";

$conn = mysqli_connect($host, $user, $pass, $db,"3307");

if (!$conn) {
    die("Koneksi gagal. Pastikan MySQL di XAMPP sudah menyala: " . mysqli_connect_error());
}
?>