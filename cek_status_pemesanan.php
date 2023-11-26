<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id_ps = $_GET['id'];

    $query = "SELECT status FROM booking WHERE id_ps = '$id_ps' LIMIT 1";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row['status'];
        if ($status == 1 || $status == 0 || $status == 3) {
            echo json_encode(array('status' => 'gagal'));
        } else {
            echo json_encode(array('status' => 'sukses'));
        }
    } else {
        echo json_encode(array('status' => 'sukses'));
    }
} else {
    echo json_encode(array('status' => 'gagal'));
}
?>