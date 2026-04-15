<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) { header("location:login.php"); exit(); }

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id'");
$d = mysqli_fetch_array($query);

if (isset($_POST['update'])) {
    $nama  = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    $update = mysqli_query($koneksi, "UPDATE barang SET nama_barang='$nama', harga='$harga', stok='$stok' WHERE id_barang='$id'");
    if ($update) {
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location='pendataan_barang.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data Barang</h2>
        <hr>
        <form method="POST" action="">
            <label>Nama Barang:</label><br>
            <input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>" required style="width:100%; padding:8px; margin:10px 0;"><br>
            
            <label>Harga:</label><br>
            <input type="number" name="harga" value="<?php echo $d['harga']; ?>" required style="width:100%; padding:8px; margin:10px 0;"><br>
            
            <label>Stok:</label><br>
            <input type="number" name="stok" value="<?php echo $d['stok']; ?>" required style="width:100%; padding:8px; margin:10px 0;"><br>
            
            <button type="submit" name="update" class="menu-btn">Update Data</button>
            <a href="pendataan_barang.php" class="menu-btn logout">Batal</a>
        </form>
    </div>
</body>
</html>