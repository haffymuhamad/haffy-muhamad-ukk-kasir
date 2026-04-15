<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'administrator') {
    echo "<script>alert('Akses Ditolak! Hanya Admin yang bisa menambah user.'); window.location='index.php';</script>";
    exit();
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']); 
    $role     = $_POST['role'];

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek_user) > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('User berhasil didaftarkan!'); window.location='index.php';</script>";
        } else {
            $error = "Gagal mendaftarkan user.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi User Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Registrasi User Baru</h2>
        <p>Gunakan form ini untuk menambah Admin atau Petugas baru.</p>
        <hr>

        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

        <form method="POST" action="">
            <label>Username:</label><br>
            <input type="text" name="username" required style="width:100%; padding:8px; margin:10px 0;"><br>
            
            <label>Password:</label><br>
            <input type="password" name="password" required style="width:100%; padding:8px; margin:10px 0;"><br>
            
            <label>Role:</label><br>
            <select name="role" required style="width:100%; padding:8px; margin:10px 0;">
                <option value="petugas">Petugas</option>
                <option value="administrator">Administrator</option>
            </select><br><br>
            
            <button type="submit" name="submit" class="menu-btn admin">Simpan User</button>
            <a href="index.php" class="menu-btn logout">Kembali</a>
        </form>
    </div>
</body>
</html>