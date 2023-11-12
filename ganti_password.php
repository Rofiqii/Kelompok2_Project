<?php
require 'koneksi.php';

if (isset($_POST['ganti_password'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $new_password = mysqli_real_escape_string($koneksi, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($koneksi, $_POST['confirm_password']);
    if ($new_password === $confirm_password) {
        $query = "UPDATE user SET password = ? WHERE username = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ss", $new_password, $username);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Gagal mengganti kata sandi. Silakan coba lagi.";
        }
    } else {
        $error = "Konfirmasi kata sandi tidak cocok. Silakan coba lagi.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password | RENTAL POWER GAMES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image slideshow-container">
                <script>
                    const slideshowContainer = document.querySelector('.slideshow-container');
                    let currentImageIndex = 0;
                    const images = [
                    'assets/3344.jpg',
                    'assets/9911.jpg',
                    'assets/1276415.jpg',
                    'assets/16170.jpg',
                    'assets/6611.jpg',
                    'assets/7722.jpg',
                    'assets/555111.jpg',
                    'assets/00122.jpg',
                    'assets/8877.jpg',
                    'assets/32221.jpg',
                    'assets/11234.jpg',
                    'assets/13212.png',
                    'assets/8881.jpg',
                    'assets/2042.jpg',
                    'assets/34441.jpg'
                    ];
                    function changeBackgroundImage() {
                    slideshowContainer.style.backgroundImage = `url('${images[currentImageIndex]}')`;
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    }
                    changeBackgroundImage();
                    setInterval(changeBackgroundImage, 15000);
                    </script>
                </div>
                <div class="col-md-6 right">
                    <form action="" method="post">
                        <br>
                        <div class="texttitle text-center">
                            <p>RENTAL POWER GAMES</p>
                        </div>
                        <h3 class="mb-3 mt-3 text-center">GANTI PASSWORD</h3>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                            <label for="new_password">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Kata Sandi Baru" required>
                            <label>Show Password</label>
                            <input type="checkbox" name="" onclick="myFunction()">
                        </div>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                            <label for="confirm_password">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="ganti_password" class="btn" id="btn-ganpass">Ganti</button>
                        </div>
                        <div class="text-center mt-3">
                            <a href="login.php" id="klikdisini">Kembali ke login.</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function myFunction() {
            var show = document.getElementById('new_password');
            if (show.type=='password'){
                show.type='text';
            }else{
                show.type='password';
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>