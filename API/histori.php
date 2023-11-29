<?php

require_once '../koneksi.php';

$customer = mysqli_query($koneksi, "SELECT * from booking");
$result = mysqli_fetch_assoc($customer);

header('Content-type: application/json');
echo json_encode($result);

?>