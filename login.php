<?php
session_start();
require 'koneksi.php';

if(isset($_POST['login'])) {
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
                $_SESSION['rentalps'] = $rentalps;
                $_SESSION['username'] = $rentalps['username'];
                $_SESSION['fullname'] = $rentalps['fullname'];
                mysqli_query($koneksi, "INSERT INTO kasir VALUES('', '". $rentalps['username'] ."')");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RENTAL POWER GAMES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
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
                    'assets/32221.jpg',
                    'assets/0099.jpg',
                    'assets/5566.jpg',
                    'assets/3399.jpg',
                    'assets/6611.jpg',
                    'assets/5511.jpg',
                    'assets/3344.jpg',
                    'assets/0022.jpg',
                    'assets/7722.jpg',
                    'assets/8877.jpg',
                    'assets/4433.jpg',
                    'assets/9911.jpg',
                    'assets/8881.jpg',
                    'assets/555111.jpg',
                    'assets/11234.jpg',
                    'assets/00122.jpg',
                    'assets/2042.jpg',
                    'assets/13212.png',
                    'assets/16170.jpg',
                    'assets/34441.jpg',
                    'assets/1276415.jpg'
                    ];
                    function changeBackgroundImage() {
                    slideshowContainer.style.backgroundImage = `url('${images[currentImageIndex]}')`;
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    }
                    changeBackgroundImage();
                    setInterval(changeBackgroundImage, 8000);
                    </script>
                </div>
                <div class="col-md-6 right">
                <form action="" method="post" class>
                    <div class="texttitle text-center">
                        <p>RENTAL POWER GAMES</p>
                    </div>
                    <h3 class="mb-3 mt-3 text-center">LOGIN</h3>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <div class="mb-3 text-light">
                            <span class="icon"><ion-icon name="person-circle-outline" id="text2"></ion-icon></span>
                            <label for="username" id="text2">Username</label>
                            <input type="username" name="username" id="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="mb-3 text-light">
                            <span class="icon"><ion-icon name="lock-closed-outline" id="text2"></ion-icon></span>
                            <label for="password" id="text2">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <label id="text2">Show Password</label>
                            <input type="checkbox" name="" onclick="myFunction()">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="login" class="btn" id="btn-login">Login</button>
                        </div>
                        <div class="text-center mt-3">
                            <p id="text2">Belum punya akun? Harap konfirmasi pada admin.</a></p>
                            <p id="text2">Atau <a href="lupa_password.php" id="klikdisini">Lupa Password?</a></p>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>