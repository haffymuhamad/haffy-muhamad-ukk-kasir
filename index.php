<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kasir Kita - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

   
    <div class="sidebar">
        <div class="sidebar-header">
            KASIR KITA
        </div>
        
        <?php if ($role == 'administrator'): ?>
            <a href="registrasi.php">Registrasi User</a>
        <?php endif; ?>
        
        <a href="pendataan_barang.php">Pendataan Barang</a>
        <a href="stok_barang.php">Stok Barang</a>
        <a href="transaksi.php">Transaksi Kasir</a>
        
        <?php if ($role == 'administrator'): ?>
            <a href="laporan.php">Laporan Penjualan</a>
        <?php endif; ?>

        <a href="logout.php" style="margin-top: auto; border-top: 1px solid #64748b;">Logout</a>
    </div>

    
    <div class="main-content">
        <div class="content-inner">
            <h1 style="font-size: 18px; opacity: 0.5;">Branda</h1>
            <hr style="border: 0.5px solid rgba(255,255,255,0.2);">
            <div style="margin-top: 50px; text-align: center;">
                <h2>Selamat Datang, <?php echo htmlspecialchars($username); ?></h2>
                <p>Silahkan pilih menu di samping untuk mulai mengelola kasir.</p>
            </div>
        </div>
    </div>

</body>
</html>