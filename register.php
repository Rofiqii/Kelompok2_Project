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
            header('Location: login.php');
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
    <title>Register - RENTAL POWER GAMES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel="stylesheet" href="style.css">
</head>

<body style="background-image: url(assets/112233.jpg);
    height: 130vh;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;">
    <div class="card-header text-center">
        <h1 class="text-light mt-3">RENTAL POWER GAMES</h1>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <div class="card" id="form">
                <div class="card-header text-center" style="border border-style: solid; border-color: rgb(255, 255, 255);">
                    <h5 class="text-light">Register</h5>
                </div>
                <div class="card-body text-light">
                    <form action="" method="post">
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
                            <button type="submit" name="register" class="btn" id="btn">Register</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p id="text">Sudah punya akun? <a href="login.php" id="klikdisini">Login disini.</a></p>
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