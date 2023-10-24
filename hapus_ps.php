<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id_ps_to_delete = $_GET['id'];
    $check_sql = "SELECT * FROM ps WHERE id_ps = '$id_ps_to_delete'";
    $check_result = $koneksi->query($check_sql);

    if ($check_result->num_rows > 0) {
        $delete_sql = "DELETE FROM ps WHERE id_ps = '$id_ps_to_delete'";
        if ($koneksi->query($delete_sql)) {
            header("Location: detail_ps.php");
            exit;
        } else {
            echo "Error saat menghapus data: " . $koneksi->error;
        }
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID PS tidak valid.";
}
?>