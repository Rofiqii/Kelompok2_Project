<?php

session_start();
require 'koneksi.php';

$rentalps = $_SESSION['rentalps'];
$name = [];

$result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '{$rentalps}'");

while($row = mysqli_fetch_assoc($result))
    $name[] = $row;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="" class="navbar-brand text-white">RENTAL POWER GAMES</a>
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
                                window.location.href = 'login.php';
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
    <h3 class="text-center text-white">Selamat Datang <?= $rentalps['fullname']; ?></h3>
    </body>
</html>
