<?php
require 'koneksi.php';

if (isset($_POST['reset_password'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $new_password = mysqli_real_escape_string($koneksi, $_POST['new_password']);
    $query = "UPDATE user SET password = ? WHERE username = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $new_password, $username);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Gagal mengganti kata sandi. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <div class="card text-white" id="card1">
                <div class="card-header text-center" id="card2">
                    <h5 class="text-light">Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="username">Username :</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password">Kata Sandi Baru :</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Kata Sandi Baru" required>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="reset_password" class="btn btn-primary" id="btn">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="login.php" id="klikdisini">Kembali ke login.</a>
        </div>
    </div>
</body>
</html>