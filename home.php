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
                    <input type="text" placeholder="Search...">
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
        <div class="text logo-text">Dashboard</div>
        <div class="card--container">
            <h1 class="main--title">Informasi</h1>
            <div class="card--wrapper">
                <div class="info--card light-blue">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title" id="text">PlayStation Aktif</span>
                            <span class="amount--value" id="text">8 PS</span>
                        </div>
                        <i class='bx bx-desktop blue icon2'></i>
                    </div>
                </div>
                <div class="info--card light-green">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title" id="text">Total Booking</span>
                            <span class="amount--value" id="text">12</span>
                        </div>
                        <i class='bx bxs-user green icon2'></i>
                    </div>
                </div>
                <div class="info--card light-yellow">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title" id="text">Pendapatan Hari Ini</span>
                            <span class="amount--value" id="text">Rp 135.000</span>
                        </div>
                        <i class='bx bx-dollar-circle yellow icon2' ></i>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="between--container">
            <div class="card--container2">
                <div class="card--wrapper2">
                    <canvas id="myChart" width="570" height="370"></canvas>
                </div>
            </div>
            <div class="card--container3">
                <div class="card--wrapper3">
                    <div class="table-container2">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-white">ID PS</th>
                                    <th class="text-white">Tipe PS</th>
                                    <th class="text-white">Jam mulai</th>
                                    <th class="text-white">Jam berakhir</th>
                                    <th class="text-white">Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
            const formatToRupiah = (value) => {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
            };
            var data = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Pendapatan',
                        data: [120000, 190000, 300000, 500000, 200000, 500000, 1000000, 125000, 900000, 150000, 800000, 700000],
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                    };
                    var options = {
                    scales: {
                        y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                            return formatToRupiah(value);
                            }
                        }
                        }
                    },
                    plugins: {
                        tooltip: {
                        callbacks: {
                            label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += formatToRupiah(context.parsed.y);
                            }
                            return label;
                            }
                        }
                        }
                    }
                    };
                    var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: options
                    });
    </script>
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
</body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>