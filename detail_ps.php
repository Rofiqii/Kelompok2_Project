<?php
session_start();
require 'koneksi.php';
$sql = "SELECT id_ps, tipe_ps, harga FROM ps";
$result = $koneksi->query($sql);

if (isset($_POST['submit'])) {
    $id_ps = $_POST['id_ps'];
    $tipe_ps = $_POST['tipe_ps'];
    $harga = $_POST['harga'];
    $check_sql = "SELECT id_ps FROM ps WHERE id_ps = '$id_ps'";
    $check_result = $koneksi->query($check_sql);
    if ($check_result->num_rows > 0) {
        echo '<script>alert("ID sudah ada. Silakan gunakan ID yang berbeda.")</script>';
        header('Refresh:0;');
    } else {
        $sql = "INSERT INTO ps (id_ps, tipe_ps, harga) VALUES ('$id_ps', '$tipe_ps', '$harga')";
        if ($koneksi->query($sql)) {
            echo '<script>alert("Data berhasil disimpan.")</script>';
            header('Refresh:0;');
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail PS - RENTAL POWER GAMES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand text-white">RENTAL POWER GAMES</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                <div class="container-logout">
                    <form action="logout.php">
                    <a href="login.php" id="klikdisini" onclick="confirmLogout(event)">Logout</a>
                        <div class="d-flex justify-content-center">
                        </div>
                        <script>
                        function confirmLogout(event) {
                            if (confirm('Yakin untuk logout?')) {
                                window.location.href = 'logout.php';
                            } else {
                                event.preventDefault();
                            }
                        }
                        </script>
                    </form> 
                </div>
                </li>
            </ul>
        </div>
    </nav>
    <a href="home.php" id="klikdisini" class="navbar-brand">Beranda</a>
    <br>
    <a href="detail_ps.php" id="klikdisini" class="navbar-brand">PlayStation</a>
    <br>
    <a href="booking.php" id="klikdisini" class="navbar-brand">Booking</a>
    <div>
        <button type="submit" class="btn text-white" id="btn" onclick="openPopup()">Tambah</button>
        <div class="popup" id="popup">
            <br>
            <h3>Formulir Penambahan Data PS</h3>
                <form action="" method="POST">
                    <label for="id_ps">ID PS : </label>
                    <input type="text" name="id_ps" class="form-control" placeholder="Isi dengan angka" required><br>
                    <label for="tipe_ps">Tipe PS : </label>
                    <select name="tipe_ps" class="form-control" required>
                        <option>Pilih PS yang akan ditambah</option>
                        <option value="PS1">PS1</option>
                        <option value="PS2">PS2</option>
                        <option value="PS3">PS3</option>
                        <option value="PS4">PS4</option>
                        <option value="PS5">PS5</option>
                    </select><br>
                    <label for="harga">Harga Per Jam : </label>
                    <input type="text" name="harga" class="form-control" placeholder="Isi tanpa Rp" required>
                    <br>
                    <button type="button" onclick="closePopup()">Kembali</button>
                    <button onclick="refreshPage()" type="submit" name="submit" id="popupbtn" class="btn text-white">Simpan Data</button>
                </form>
        </div>
    </div>
    <table class="table table-striped table-dark">
        <tr>
            <th class="text-white">ID PS</th>
            <th class="text-white">Tipe PS</th>
            <th class="text-white">Harga Per Jam</th>
            <th class="text-white">Hapus</th>
            <th class="text-white">Edit</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_ps"] . "</td>";
                    echo "<td>" . $row["tipe_ps"] . "</td>";
                    echo "<td>" . $row["harga"] . "</td>";
                    echo "<td><a href='hapus_ps.php?id=" . $row['id_ps'] . "' class='btn btn-danger btn-sm' onclick='konfirmasiHapus()'>Hapus</a></td>";
                    echo "<td><a href='edit_ps.php?id=" . $row['id_ps'] . "' class='btn btn-primary btn-sm'>Edit</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Tidak ada data yang ditemukan</td></tr>";
            }
        ?>
    </table>

        <script>
            let popup = document.getElementById("popup");

            function openPopup(){
                popup.classList.add("open-popup");
                window.addEventListener("scroll", movePopup);
            }

            function closePopup(){
                popup.classList.remove("open-popup");
                window.removeEventListener("scroll", movePopup);
            }

            function refreshPage() {
                location.reload();
            }

            function movePopup() {
            popup.style.top = (window.scrollY + window.innerHeight / 2) + "px";
            popup.style.left = (window.scrollX + window.innerWidth / 2) + "px";
            }

            function konfirmasiHapus() {
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            window.location.href = 'hapus_ps.php?id=' + id_ps;
        } else {
        }
    }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>