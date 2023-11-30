<?php

require_once '../koneksi.php';
$values = file_get_contents('php://input');
$data = json_decode($values);

$customer = mysqli_query($koneksi, "SELECT * FROM customer WHERE username_cus = '$data->username_cus' AND password_cus = '$data->password_cus'");

$result = mysqli_fetch_assoc($customer);


header('Content-type: application/json');

if (!is_null($result)) {
    echo json_encode([
        'status' => 'ok',
        'pesan' => 'Login Berhasil',
        'customer' => $result,
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'pesan' => 'Login gagal',
    ]);
}

?>