<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

if (isset($_POST['tambah'])) {
    $nama  = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    $query = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama', '$harga', '$stok')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Barang Berhasil Ditambah!'); window.location='pendataan_barang.php';</script>";
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    header("location:pendataan_barang.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendataan Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Pendataan Barang</h2>
        <a href="index.php" class="menu-btn logout">Kembali ke Dashboard</a>
        <hr>

        <h3>Tambah Barang Baru</h3>
        <form method="POST" action="">
            <input type="text" name="nama_barang" placeholder="Nama Barang" required style="padding:8px; margin-right:5px;">
            <input type="number" name="harga" placeholder="Harga" required style="padding:8px; margin-right:5px;">
            <input type="number" name="stok" placeholder="Stok" required style="padding:8px; margin-right:5px;">
            <button type="submit" name="tambah" class="menu-btn">Tambah</button>
        </form>

        <hr>
        <h3>Daftar Barang</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php
            $data = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($d = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?php echo $d['id_barang']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $d['stok']; ?></td>
                <td>
                    <a href="edit_barang.php?id=<?php echo $d['id_barang']; ?>" style="color:blue; text-decoration:none;">Edit</a> | 
                    <a href="pendataan_barang.php?hapus=<?php echo $d['id_barang']; ?>" 
                    onclick="return confirm('Yakin ingin hapus barang ini?')" 
                    style="color:red; text-decoration:none;">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>