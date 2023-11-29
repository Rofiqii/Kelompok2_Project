<?php
require_once '../koneksi.php';

$values = file_get_contents('php://input');
$data = json_decode($values);

$queryps = mysqli_query($koneksi, "SELECT * FROM ps WHERE id_ps = $data->id_ps");
$ps = mysqli_fetch_row($queryps);

$waktuAwal = DateTime::createFromFormat('H:i:s', $data->waktu_awal);
$waktuAkhir = DateTime::createFromFormat('H:i:s', $data->waktu_akhir);

$menit = ($waktuAkhir->getTimestamp() - $waktuAwal->getTimestamp()) / 60;
$harga = ($menit / 60) * $ps[2];
$tanggalHariIni = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO booking (username, username_cus, id_pemesanan, id_ps, waktu_awal, waktu_akhir, total_harga, tanggal, status) VALUES ('{$data->username}', '{$data->username_cus}', '{$data->id_pemesanan}', '{$data->id_ps}', '{$data->waktu_awal}', '{$data->waktu_akhir}', '{$harga}', '$tanggalHariIni', '{$data->status}')");

$affectedRows = mysqli_affected_rows($koneksi);
header('Content-Type: application/json');

if ($affectedRows > 0) {
    echo json_encode([
        'status' => 'ok',
        'pesan' => 'Booking berhasil',
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'pesan' => 'Gagal melakukan booking',
    ]);
}
?>