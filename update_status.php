<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rentalps";
$conn = mysqli_connect($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$updateQuery = "UPDATE booking SET status = 'Kosong' WHERE status = 'Bermain' AND waktu_akhir < NOW()";
if ($conn->query($updateQuery) === TRUE) {
    $sql = "SELECT ps.ID_PS, ps.Tipe_PS, booking.waktu_awal, booking.waktu_akhir, booking.status
            FROM ps 
            LEFT JOIN booking ON ps.ID_PS = booking.ID_PS";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        }
    } else {
        echo "<tr><td colspan='5'>Tidak ada data yang ditemukan</td></tr>";
    }
} else {
    echo "Error: " . $updateQuery . "<br>" . $conn->error;
}
$conn->close();
?>