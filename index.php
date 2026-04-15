<?php
session_start();
include 'koneksi.php';


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$username = $_SESSION['username'];
$role     = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Kasir - Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Selamat Datang, <?php echo htmlspecialchars($username); ?></h2>
        <p style="color: #666; margin-top: 0;">Role: <strong><?php echo strtoupper($role); ?></strong></p>
        <hr>

        <div class="menu">
            <a href="pendataan_barang.php" class="menu-btn"> Pendataan Barang</a>
            <a href="stok_barang.php" class="menu-btn"> Stok Barang</a>
            <a href="transaksi.php" class="menu-btn transaksi"> Transaksi Kasir</a>

            <?php if ($role == 'administrator'): ?>
                <a href="registrasi.php" class="menu-btn admin"> Registrasi User Baru</a>
                <a href="laporan.php" class="menu-btn laporan">Laporan Penjualan</a>
            <?php endif; ?>

            <a href="logout.php" class="menu-btn logout"> Logout</a>
        </div>
    </div>
</body>
</html>