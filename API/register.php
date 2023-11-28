<?php

require_once '../koneksi.php';
$values = file_get_contents('php://input');
$data = json_decode($values);

$query = mysqli_query($koneksi, "INSERT INTO customer (username_cus, fullname_cus, password_cus, pertanyaan, jawaban) VALUES ('{$data->username_cus}', '{$data->fullname_cus}', '{$data->password_cus}', '{$data->pertanyaan}', '{data->jawaban}')");

$affectedRows = mysqli_affected_rows($koneksi);

header('Content-Type: application/json');

if ($affectedRows > 0)
    echo json_encode([
        'status' => 'ok',
        'pesan' => 'Register berhasil',
    ]);
?>