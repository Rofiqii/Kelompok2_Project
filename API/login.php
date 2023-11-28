<?php

require_once './koneksi.php';

$customer = mysqli_query($conn, "SELECT from customer");
$result = mysqli_fetch_assoc($customer);

header('Content-type: application/json');
echo json_encode($result);

?>