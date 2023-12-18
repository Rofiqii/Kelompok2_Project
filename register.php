<?php

require 'koneksi.php';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $name = mysqli_real_escape_string($koneksi, $_POST['fullname']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $pass2 = mysqli_real_escape_string($koneksi, $_POST['password2']);
    $question = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
    $answer = mysqli_real_escape_string($koneksi, $_POST['jawaban']);
    $check_query = "SELECT * FROM user WHERE username = '$username'";
    $check_result = mysqli_query($koneksi, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $error = "Username sudah digunakan. Silakan gunakan username lain.";
    } elseif ($pass === $pass2) {
        $query = "INSERT INTO user (`username`, `fullname`, `password`, `pertanyaan`, `jawaban`)
            VALUES ('$username', '$name', '$pass', '$question', '$answer')";
        $result = mysqli_query($koneksi, $query);
        
        if ($result) {
            header('Location: home.php');
        } else {
            $error = "Gagal menambahkan pengguna. Silakan coba lagi.";
        }
    } else {
        $error = "Password tidak cocok. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | RENTAL POWER GAMES</title>
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
                    'assets/2042.jpg',
                    'assets/11234.jpg',
                    'assets/00122.jpg',
                    'assets/4433.jpg',
                    'assets/5511.jpg',
                    'assets/5566.jpg',
                    'assets/3399.jpg',
                    'assets/1276415.jpg',
                    'assets/8881.jpg',
                    'assets/0099.jpg',
                    'assets/34441.jpg',
                    'assets/13212.png',
                    'assets/9911.jpg',
                    'assets/32221.jpg',
                    'assets/0022.jpg',
                    'assets/6611.jpg',
                    'assets/3344.jpg',
                    'assets/7722.jpg',
                    'assets/8877.jpg',
                    'assets/555111.jpg',
                    'assets/16170.jpg'
                    ];
                    function changeBackgroundImage() {
                    slideshowContainer.style.backgroundImage = `url('${images[currentImageIndex]}')`;
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    }
                    changeBackgroundImage();
                    setInterval(changeBackgroundImage, 8000);
                    </script>
                </div>
                <div class="col-md-6 right-register">
                    <form action="" method="post">
                    <br>
                    <div class="texttitle text-center">
                        <p>RENTAL POWER GAMES</p>
                    </div>
                        <h3 class="mb-3 mt-3 text-center">REGISTER</h3>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                            <label for="fullname">Nama Lengkap</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <label>Show Password</label>
                            <input type="checkbox" name="" onclick="myFunction()">
                        </div>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                            <label for="password2">Konfirmasi Password</label>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="help-circle-outline"></ion-icon></span>
                            <label for="pertanyaan">Pertanyaan :</label>
                            <br>
                            <select name="pertanyaan" id="pertanyaan" class="form-control">
                                <option>Pilih Pertanyaan</option>
                                <option value="Apa warna favoritmu?">Apa warna favoritmu?</option>
                                <option value="Apa makanan kesukaanmu?">Apa makanan kesukaanmu?</option>
                                <option value="Apa minuman kesukaanmu?">Apa minuman favoritmu?</option>
                                <option value="Apa film favoritmu?">Apa film favoritmu?</option>
                                <option value="Siapa nama hewan peliharaanmu??">Siapa nama hewan peliharaanmu?</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <span class="icon"><ion-icon name="checkmark-circle-outline"></ion-icon></span>
                            <label for="jawaban">Jawaban (Perhatikan huruf kapitalnya)</label>
                            <input type="text" name="jawaban" id="jawaban" class="form-control" placeholder="Jawaban" required>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" name="register" class="btn" id="btn-register">Register</button>
                        </div>
                        <div class="text-center mt-3">
                            <p><a href="home.php" id="klikdisini">Kembali</a></p>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function myFunction() {
            var show = document.getElementById('password');
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