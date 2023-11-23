<?php
session_start();
require 'koneksi.php';
$rentalps = isset($_SESSION['rentalps']['username']) ? $_SESSION['rentalps']['username'] : null;
$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '{$rentalps}'");
while($row = mysqli_fetch_assoc($result))
$name = $row['fullname'];
$query = "SELECT b.id_pemesanan, b.tanggal, b.total_harga AS pendapatan FROM booking b WHERE b.status != 0";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Gagal mengambil data: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan | RENTAL POWER GAMES</title>
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel="stylesheet" href="style.css">
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
                        <a href="home.php">
                            <i class='bx bx-home-alt icon'></i>
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
        <div class="text logo-text">Laporan Keuangan</div>
        <div class="tabular--wrapper">
        <h1 class="main--title">Tabel Keuangan</h1>
        <div class="table-container-lap-keuangan">
            <table>
                <thead>
                    <tr>
                        <th class="text-white">ID Pemesanan</th>
                        <th class="text-white">Tanggal Pemesanan</th>
                        <th class="text-white">Pendapatan</th>
                    </tr>
                </thead>
                <?php
                $total_pendapatan = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_pemesanan'] . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td>" . $row['pendapatan'] . "</td>";
                    echo "</tr>";
                    $total_pendapatan += $row['pendapatan'];
                }
                $pendapatan_hari_ini = 'Rp ' . number_format($total_pendapatan, 0, ',', '.');
                ?>
            </table>
        </div>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td colspan='2' class='font-pendapatan'><strong>Total Pendapatan :</strong> <?php echo $total_pendapatan; ?></td>
                    </tr>
                </tbody>
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