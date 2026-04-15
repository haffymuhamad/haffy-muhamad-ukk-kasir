<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username'])) { header("location:login.php"); exit(); }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Laporan Stok Barang</h2>
        <a href="index.php" class="menu-btn logout">Kembali ke Dashboard</a>
        <hr>
        <table>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Sisa Stok</th>
                <th>Status</th>
            </tr>
            <?php
            $data = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY stok ASC");
            while ($d = mysqli_fetch_array($data)) {
                
                $status = ($d['stok'] <= 5) ? "<b style='color:red;'>Hampir Habis!</b>" : "Tersedia";
            ?>
            <tr>
                <td><?php echo $d['nama_barang']; ?></td>
                <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                <td><?php echo $d['stok']; ?></td>
                <td><?php echo $status; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>