<?php
session_start();

// Redirect kalau sudah login
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    } else {
        header("Location: kades/dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Kependudukan Desa</title>
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h2></h2>
    <div class="nav-btn">
        <a href="auth/login.php" class="btn-outline">login</a>    
        <a href="auth/register.php" class="btn-outline">Register</a>
    </div>
</div>

<!-- HERO -->
<div class="hero">
    <div class="overlay"></div>

    <div class="content">
        <h1>Sistem Kependudukan Desa</h1>

        <p>
            Aplikasi ini dirancang untuk membantu dalam mengelola berbagai data kependudukan secara terintegrasi,
            mulai dari data penduduk, data kelahiran, data kematian, hingga data perpindahan penduduk. Dengan 
            memanfaatkan sistem berbasis digital, pengelolaan data menjadi lebih cepat, akurat, dan efisien, sehingga 
            dapat meminimalisir kesalahan pencatatan serta mempermudah proses pencarian dan pelaporan data bagi 
            pihak yang berkepentingan.
        </p>
    </div>
</div>

</body>
</html>