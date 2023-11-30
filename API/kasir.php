<?php

require_once '../koneksi.php';

$kasir = mysqli_query($koneksi, "SELECT * FROM kasir ORDER BY id DESC LIMIT 1");
$result = mysqli_fetch_assoc($kasir);

header('Content-type: application/json');
echo json_encode($result);