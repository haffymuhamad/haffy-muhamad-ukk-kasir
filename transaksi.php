<?php
session_start();
include 'koneksi.php';

if (isset($_POST['bayar'])) {
    $id_barang = $_POST['id_barang'];
    $jumlah    = $_POST['jumlah'];
    $kasir     = $_SESSION['username'];

    // Ambil data barang untuk dapat harga & nama
    $barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
    $b = mysqli_fetch_array($barang);
    
    if ($b['stok'] >= $jumlah) {
        $total = $b['harga'] * $jumlah;
        $nama_b = $b['nama_barang'];

        // 1. Masuk ke laporan
        mysqli_query($koneksi, "INSERT INTO laporan_penjualan (nama_barang, jumlah, total_harga, kasir) 
                                VALUES ('$nama_b', '$jumlah', '$total', '$kasir')");
        
        // 2. Kurangi stok barang
        mysqli_query($koneksi, "UPDATE barang SET stok = stok - $jumlah WHERE id_barang='$id_barang'");

        echo "<script>alert('Transaksi Berhasil!'); window.location='laporan.php';</script>";
    } else {
        echo "<script>alert('Stok tidak mencukupi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Kasir</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Input Transaksi Baru</h2>
        <form method="POST">
            <label>Pilih Barang:</label>
            <select name="id_barang" required style="width:100%; padding:8px; margin:10px 0;">
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM barang WHERE stok > 0");
                while($row = mysqli_fetch_array($res)){
                    echo "<option value='".$row['id_barang']."'>".$row['nama_barang']." (Stok: ".$row['stok'].")</option>";
                }
                ?>
            </select>
            <label>Jumlah Beli:</label>
            <input type="number" name="jumlah" min="1" required style="width:100%; padding:8px; margin:10px 0;">
            <button type="submit" name="bayar" class="menu-btn">Proses Bayar</button>
            <a href="index.php" class="menu-btn logout">Batal</a>
        </form>
    </div>
</body>
</html>