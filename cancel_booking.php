<?php
require 'koneksi.php';

if (isset($_GET['ID_PS'])) {
    $id_ps_to_update = $_GET['ID_PS'];
    $update_sql = "UPDATE booking SET status = '3', waktu_awal = NULL, waktu_akhir = NULL WHERE ID_PS = ?";
    $update_stmt = $koneksi->prepare($update_sql);
    $update_stmt->bind_param("s", $id_ps_to_update);
    if ($update_stmt->execute()) {
        header("Location: home.php");
        exit;
    } else {
        echo "Error saat memperbarui data: " . $koneksi->error;
    }
} else {
    echo "ID PS tidak valid.";
}
?>