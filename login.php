<?php
session_start();
require 'koneksi.php';

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);

    if(!empty(trim($username)) && !empty(trim($pass))) {
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            $rentalps = mysqli_fetch_assoc($result);
            if($rentalps['password'] == $pass) {
                $_SESSION['rentalps'] = $user;
                header('Location: home.php');
            } else {
                $error = "Username atau password salah";
            }
        } else {
            $error = "User tidak ditemukan";
        }
    } else {
        $error = "Data tidak boleh kosong";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <div class="card text-white mt-4" id="card1">
                <div class="card-header text-center" id="card2">
                    <h5 class="text-light">Login</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="username" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="submit" class="btn btn-primary" id="btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <p id="text">Belum punya akun? <a href="register.php" id="klikdisini">Daftar disini.</a></p>
                <p id="text">Atau <a href="lupa_password.php" id="klikdisini">Lupa Password?</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>