<?php
session_start();
require 'koneksi.php';
$rentalps = isset($_SESSION['rentalps']['username']) ? $_SESSION['rentalps']['username'] : null;
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
    <title>Booking | RENTAL POWER GAMES</title>
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        <div class="text logo-text">Booking</div>
        <div class="tabular--wrapper">
        <h1 class="main--title">Tabel Booking</h1>
        <div class="table-container3">
            <table>
                <thead>
                    <tr>
                        <th class="text-white">Admin</th>
                        <th class="text-white">Customer</th>
                        <th class="text-white">ID Pemesanan</th>
                        <th class="text-white">ID PS</th>
                        <th class="text-white">Waktu Awal</th>
                        <th class="text-white">Waktu Akhir</th>
                        <th class="text-white">Total Harga</th>
                        <th class="text-white">Tanggal</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Konfirmasi</th>
                </thead>
                <?php
                    $servername = "localhost";
                    $username = "rentalpo_rentalpo";
                    $password = "Celanakotak54321";
                    $database = "rentalpo_rentalps";
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    if (!$conn) {
                        die("Koneksi gagal: " . mysqli_connect_error());
                    }
                    $sql = "SELECT * FROM booking";
                    $sql = "SELECT b.*, u_admin.fullname AS admin_name, u_customer.fullname_cus AS customer_name 
                    FROM booking b
                    LEFT JOIN user u_admin ON b.username = u_admin.username
                    LEFT JOIN customer u_customer ON b.username_cus = u_customer.username_cus";
                    $result = $conn->query($sql);
                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['admin_name'] . "</td>";
                            echo "<td>" . $row['customer_name'] . "</td>";
                            echo "<td>" . $row['id_pemesanan'] . "</td>";
                            echo "<td>" . $row['id_ps'] . "</td>";
                            echo "<td>" . $row['waktu_awal'] . "</td>";
                            echo "<td>" . $row['waktu_akhir'] . "</td>";
                            echo "<td>" . $row['total_harga'] . "</td>";
                            echo "<td>" . $row['tanggal'] . "</td>";
                            $status = "";
                            if ($row['status'] == 1) {
                                $status = "DITERIMA";
                            } elseif ($row['status'] == 0) {
                                $status = "DITOLAK";
                            } elseif ($row['status'] == 3) {
                                $status = "SELESAI";
                            } else {
                                $status = "MENUNGGU KONFIRMASI";
                            }
                            echo "<td>" . $status . "</td>";
                            echo "<td>";
                            if ($status == "MENUNGGU KONFIRMASI") {
                                echo "<a class='fas fa-check btn-terima' href='konfirmasi_process.php?id=" . $row['id_pemesanan'] . "&status=1'></a>";
                                echo "<a class='fas fa-times btn-tolak' href='konfirmasi_process.php?id=" . $row['id_pemesanan'] . "&status=0'></a>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "Tidak ada data booking.";
                    }
                    $conn->close();
                    ?>
                    </tr>
            </table>
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
</body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>