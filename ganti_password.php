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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - RENTAL POWER GAMES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css?version=1">

</head>
<body>
    <div class="card-header text-center">
        <h1 class="text-light mt-3">RENTAL POWER GAMES</h1>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <div class="card text-white shadow-lg" id="form">
                <div class="card-header text-center" style="border: border-style: solid; border-color: rgb(255, 255, 255);">
                    <h5 class="text-light">Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
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
                            <button type="submit" name="ganti_password" class="btn text-light" id="btn">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="login.php" id="klikdisini">Kembali ke login.</a>
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