<?php
require 'koneksi.php';

if (isset($_POST['lupa_password'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pertanyaan = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
    $jawaban = mysqli_real_escape_string($koneksi, $_POST['jawaban']);

    $query = "SELECT * FROM user WHERE username = ? AND pertanyaan = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $pertanyaan);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($user['jawaban'] === $jawaban) {
            header("Location: ganti_password.php?username=$username");
            exit();
        } else {
            $error = "Jawaban pertanyaan salah.";
        }
    } else {
        $error = "User tidak ditemukan atau pertanyaan keamanan tidak cocok.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | RENTAL POWER GAMES</title>
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
                    'assets/00122.jpg',
                    'assets/0099.jpg',
                    'assets/7722.jpg',
                    'assets/8877.jpg',
                    'assets/555111.jpg',
                    'assets/11234.jpg',
                    'assets/1276415.jpg',
                    'assets/8881.jpg',
                    'assets/5511.jpg',
                    'assets/34441.jpg',
                    'assets/16170.jpg',
                    'assets/13212.png',
                    'assets/9911.jpg',
                    'assets/3399.jpg',
                    'assets/4433.jpg',
                    'assets/0022.jpg',
                    'assets/32221.jpg',
                    'assets/5566.jpg',
                    'assets/6611.jpg',
                    'assets/3344.jpg',
                    'assets/2042.jpg'
                    ];
                    function changeBackgroundImage() {
                    slideshowContainer.style.backgroundImage = `url('${images[currentImageIndex]}')`;
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    }
                    changeBackgroundImage();
                    setInterval(changeBackgroundImage, 8000);
                    </script>
                </div>
                    <div class="col-md-6 right-luppass">
                        <form action="" method="post">
                            <br>
                            <div class="texttitle text-center">
                                <p>RENTAL POWER GAMES</p>
                            </div>
                            <h3 class="mb-3 mt-3 text-center">LUPA PASSWORD</h3>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger"><?= $error; ?></div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <span class="icon"><ion-icon name="help-circle-outline"></ion-icon></span>
                                <label for="pertanyaan">Pertanyaan</label>
                                <select name="pertanyaan" id="pertanyaan" class="form-control" required>
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
                                <label for="jawaban">Jawaban</label>
                                <input type="text" name="jawaban" id="jawaban" class="form-control" placeholder="Jawaban" required>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="lupa_password" class="btn" id="btn-luppass">Submit</button>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>