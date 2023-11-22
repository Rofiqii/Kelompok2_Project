<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rentalps";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id_pemesanan = $_GET['id'];
    $status = $_GET['status'];
    $update_sql = "UPDATE booking SET status = $status WHERE id_pemesanan = $id_pemesanan";
    if (mysqli_query($conn, $update_sql)) {
        echo '<script>alert("Data berhasil dikonfirmasi.");</script>';
        echo '<script>window.location.href = "booking.php";</script>';
    } else {
        echo "Error: " . $update_sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Parameter tidak lengkap.";
}
mysqli_close($conn);
?>