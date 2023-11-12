<?php
require 'koneksi.php';

if (isset($_POST['submit'])) {
    $id_ps = $_POST['id_ps'];
    $tipe_ps = $_POST['tipe_ps'];
    $harga = $_POST['harga'];
    $sql = "UPDATE ps SET tipe_ps = '$tipe_ps', harga = '$harga' WHERE id_ps = '$id_ps'";
    if ($koneksi->query($sql)) {
        echo '<script>alert("Data berhasil diubah.")</script>';
        echo '<script>window.location.href = "detail_ps.php?id=' . $id_ps . '";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$id_ps_to_edit = isset($_GET['id']) ? $_GET['id'] : null;
$sql = "SELECT id_ps, tipe_ps, harga FROM ps WHERE id_ps = '$id_ps_to_edit'";
$result = $koneksi->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit PS | RENTAL POWER GAMES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
    </nav>
    <div class="row justify-content-center pt-4">
        <div class="col-md-4">
            <div class="card mt-4 shadow-lg" id="form2">
                <div class="text-center"></div>
                    <div class="container text-white">
                        <h2 class="text-center text-logo" id="text2">Edit Data PlayStation</h2>
                        <form action="" method="POST">
                            <div class="d-flex justify-content-center">
                                <p id="text2">ID PS : <?php echo $row['id_ps']; ?></p>
                            </div>
                            <input type="hidden" name="id_ps" class="form-control" value="<?php echo $row['id_ps']; ?>">
                            <label for="tipe_ps" id="text2">Tipe PS :</label>
                            <input type="text" name="tipe_ps" class="form-control" value="<?php echo $row['tipe_ps']; ?>" required>
                            <br>
                            <label for="harga" id="text2">Harga Per Jam :</label>
                            <input type="text" name="harga" class="form-control" value="<?php echo $row['harga']; ?>" required>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="submit" class="btn" id="btn">Simpan Perubahan</button>
                            </div>
                        </form>
                        <br>
                        <div class="d-flex justify-content-center">
                        <a href="detail_ps.php" id="klikdisini2">Kembali</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function refreshPage() {
                location.reload();
            }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>