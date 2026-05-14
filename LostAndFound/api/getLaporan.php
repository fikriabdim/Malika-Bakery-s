<?php
require_once "../functions/laporan.php";
$data = getAllLaporan();

$result = [];
while($row = mysqli_fetch_assoc($data)){
    $result[] = $row;
}

echo json_encode($result);
