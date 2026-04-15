<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Riwayat Laporan Penjualan</h2>
        <a href="index.php" class="menu-btn">Dashboard</a>
        <button onclick="window.print()" class="menu-btn admin">Cetak Laporan</button>
        <hr>
        <table>
            <tr>
                <th>Waktu</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Total Bayar</th>
                <th>Kasir</th>
            </tr>
            <?php
            $total_semua = 0;
            $data = mysqli_query($koneksi, "SELECT * FROM laporan_penjualan ORDER BY tgl_transaksi DESC");
            while ($d = mysqli_fetch_array($data)) {
                $total_semua += $d['total_harga'];
            ?>
            <tr>
                <td><?php echo $d['tgl_transaksi']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td><?php echo $d['jumlah']; ?></td>
                <td>Rp <?php echo number_format($d['total_harga'], 0, ',', '.'); ?></td>
                <td><?php echo $d['kasir']; ?></td>
            </tr>
            <?php } ?>
            <tr style="background:#eee; font-weight:bold;">
                <td colspan="3" align="right">TOTAL PENDAPATAN:</td>
                <td colspan="2">Rp <?php echo number_format($total_semua, 0, ',', '.'); ?></td>
            </tr>
        </table>
    </div>
</body>
</html>