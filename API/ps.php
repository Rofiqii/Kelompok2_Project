<?php

require_once '../koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM ps WHERE id_ps NOT IN(SELECT id_ps FROM booking WHERE status = 1)");
$data = [];

while($ps = mysqli_fetch_assoc($query)) {
    $data[] = $ps;
}

header('Content-Type: application/json');

echo json_encode([
    'ps' => $data,
]);