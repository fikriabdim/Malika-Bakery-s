<?php
session_start();
include "../config/database.php";
$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM laporan WHERE id = $id");
$d = mysqli_fetch_assoc($res);
if($d['user_id'] == $_SESSION['user_id']) {
    unlink("../assets/img/" . $d['foto']);
    mysqli_query($conn, "DELETE FROM laporan WHERE id = $id");
}
header("Location: ../index.php");
?>