<?php
session_start();
require 'koneksi.php';

$rentalps = isset($_SESSION['rentalps']['username']) ? $_SESSION['rentalps']['username'] : null;
$name = "";
$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '{$rentalps}'");
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['fullname'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | RENTAL POWER GAMES</title>
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
        overflow: hidden;
        margin: 0;
        padding: 0;
        }
    </style>
</head>

<body>
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <i class='bx bxs-joystick icon'></i>
                </span>
                <div class="text logo-text">
                    <span class="name">Rental</span>
                    <span class="profession">Power Games</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search...">
                </li>
                <ul class="menu-links">
                <li class="nav-link">
                        <a href="home.php" id="klikdisini" class="navbar-brand">
                            <i class='bx bx-home-alt icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="detail_ps.php">
                            <i class='bx bx-joystick-alt icon'></i>
                            <span class="text nav-text">PlayStation</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="booking.php">
                            <i class='bx bxs-book-content icon'></i>
                            <span class="text nav-text">Booking</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="lap_keuangan.php">
                            <i class='bx bx-money-withdraw icon'></i>
                            <span class="text nav-text">Laporan Keuangan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <i class='bx bx-user-circle icon'></i>
                    <span class="text logo-text profession"><?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Nama Profile'; ?></span>
                </li>
                <li class="nav-link">
                    <a href="register.php" id="klikdisini" class="navbar-brand">
                        <i class='bx bx-user-plus icon'></i>
                        <span class="text nav-text">Daftar Admin Baru</span>
                    </a>
                </li>
                <li class="" href="login.php" onclick="confirmLogout(event)">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                        <script>
                            function confirmLogout(event) {
                                if (confirm('Yakin untuk logout?')) {
                                    window.location.href = 'logout.php';
                                } else {
                                    event.preventDefault();
                                }
                            }
                        </script>
                    </a>
                </li>
            </div>
        </div>
    </nav>
    <section class="home">  
        <div class="text logo-text">Dashboard</div>
        <div class="card--container">
            <h1 class="main--title">Informasi</h1>
            <div class="card--wrapper">
                <div class="info--card light-blue">
                <?php
                $servername = "localhost";
                $username = "rentalpo_rentalpo";
                $password = "Celanakotak54321";
                $database = "rentalpo_rentalps";
                $conn = mysqli_connect($servername, $username, $password, $database);
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }
                $sql = "SELECT COUNT(DISTINCT ps.ID_PS) AS total_ps 
                        FROM ps 
                        INNER JOIN booking ON ps.ID_PS = booking.ID_PS 
                        WHERE booking.status = 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $total_ps = $row["total_ps"];
                } else {
                    $total_ps = 0;
                }
                $conn->close();
                ?>
                    <div class="card--header">
                        <div class="amount">
                            <span class="title" id="text">PlayStation Aktif</span>
                            <span class="amount--value" id="text"><?php echo $total_ps; ?> PS</span>
                        </div>
                        <i class='bx bx-desktop blue icon2'></i>
                    </div>
                </div>
                <div class="info--card light-green">
                    <?php
                    $servername = "localhost";
                    $username = "rentalpo_rentalpo";
                    $password = "Celanakotak54321";
                    $database = "rentalpo_rentalps";
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    if (!$conn) {
                        die("Koneksi gagal: " . mysqli_connect_error());
                    }
                    $countResult = $conn->query("SELECT COUNT(*) AS total_bookings FROM booking WHERE status != 0");
                    $totalBookings = 0;
                    if ($countResult && $countResult->num_rows > 0) {
                        $countData = $countResult->fetch_assoc();
                        $totalBookings = $countData['total_bookings'];
                    }
                    ?>
                    <div class="card--header">
                        <div class="amount">
                            <span class="title" id="text">Total Booking</span>
                            <span class="amount--value" id="text"><?php echo $totalBookings; ?></span>
                        </div>
                        <i class='bx bxs-user green icon2'></i>
                    </div>
                </div>
                <div class="info--card light-yellow">
                    <?php
                    $servername = "localhost";
                    $username = "rentalpo_rentalpo";
                    $password = "Celanakotak54321";
                    $database = "rentalpo_rentalps";
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    if (!$conn) {
                        die("Koneksi gagal: " . mysqli_connect_error());
                    }
                    $result = $conn->query("SELECT SUM(total_harga) AS total_harga FROM booking WHERE status != 0");
                    $totalHarga = 0;
                    if ($result && $result->num_rows > 0) {
                        $data = $result->fetch_assoc();
                        $totalHarga = $data['total_harga'];
                    }
                    ?>
                    <div class="card--header">
                        <div class="amount">
                            <span class="title" id="text">Pendapatan</span>
                            <span class="amount--value" id="text">Rp.<?php echo $totalHarga; ?></span>
                        </div>  
                        <i class='bx bx-dollar-circle yellow icon2'></i>
                    </div>
                </div>
            </div>
        </div>
        <br>
            <div class="card--container2">
                <div class="card--wrapper2">
                    <div class="table-container2">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-white">ID PS</th>
                                    <th class="text-white">Tipe PS</th>
                                    <th class="text-white">Jam mulai</th>
                                    <th class="text-white">Jam selesai</th>
                                    <th class="text-white">Status</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $servername = "localhost";
                                $username = "rentalpo_rentalpo";
                                $password = "Celanakotak54321";
                                $database = "rentalpo_rentalps";
                                $conn = mysqli_connect($servername, $username, $password, $database);
                                if ($conn->connect_error) {
                                    die("Koneksi gagal: " . $conn->connect_error);
                                }
                                $sql = "SELECT ps.ID_PS, ps.Tipe_PS, booking.waktu_awal, booking.waktu_akhir, booking.status
                                    FROM ps 
                                    LEFT JOIN booking ON ps.ID_PS = booking.ID_PS
                                    WHERE (booking.id_pemesanan IS NULL 
                                          OR booking.id_pemesanan = (
                                              SELECT MAX(id_pemesanan)
                                              FROM booking b
                                              WHERE b.ID_PS = ps.ID_PS
                                              )
                                          )";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>" . $row["ID_PS"] . "</td>
                                                <td>" . $row["Tipe_PS"] . "</td>
                                                <td>";
                                        if (($row["status"] === null || $row["status"] == 0 || $row["status"] == 3) || ($row["waktu_awal"] === null || $row["waktu_awal"] == "00:00:00")) {
                                            echo "";
                                        } else {
                                            echo $row["waktu_awal"];
                                        }
                                        echo "</td>
                                                <td>";
                                        if (($row["status"] === null || $row["status"] == 0 || $row["status"] == 3) || ($row["waktu_akhir"] === null || $row["waktu_akhir"] == "00:00:00")) {
                                            echo "";
                                        } else {
                                            echo $row["waktu_akhir"];
                                        }
                                        echo "</td>
                                                <td>";
                                        if ($row["status"] === null || $row["status"] == 0) {
                                            echo "Kosong";
                                        } elseif ($row["status"] == 1) {
                                            echo "Bermain";
                                        } elseif ($row["status"] == 3) {
                                            echo "Kosong";
                                        } else {
                                            echo $row["status"];
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                        if ($row["status"] == 1) {
                                            echo "<a href='cancel_booking.php?ID_PS=" . $row["ID_PS"] . "'>Selesai</a>";
                                        } elseif ($row["status"] === null || $row["status"] == 0) {
                                            echo "";
                                        } else {
                                            echo "";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>Tidak ada data yang ditemukan</td></tr>";
                                }
                                $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>

    <script>
        const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        searchBtn = body.querySelector(".search-box"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");
        if (localStorage.getItem("theme") === "dark") {
        body.classList.add("dark");
        modeText.innerText = "Light mode";
        }
        toggle.addEventListener("click" , () =>{
            sidebar.classList.toggle("close");
        })
        searchBtn.addEventListener("click" , () =>{
            sidebar.classList.remove("close");
        })
        modeSwitch.addEventListener("click" , () =>{
            body.classList.toggle("dark");
            if(body.classList.contains("dark")){
                modeText.innerText = "Light mode";
                localStorage.setItem("theme", "dark");
            }else{
                modeText.innerText = "Dark mode";
                localStorage.setItem("theme", "light");
            }
        });
    </script>
    <script>
        function searchTable() {
        let input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
    </script>
    <script>
    function updateStatus() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("rentalps").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "update_status.php", true);
            xmlhttp.send();
        }
        setInterval(updateStatus, 30000);
    </script>
</body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>