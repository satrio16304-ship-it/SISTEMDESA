<?php
session_start();
require '../config/koneksi.php';

if ($_SESSION['role'] != 'kades') {
    header("Location: ../auth/login.php");
    exit;
}

$total_penduduk = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM penduduk"))['total'];
$total_kelahiran = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM kelahiran"))['total'];
$total_kematian = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM kematian"))['total'];
$total_pindah = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM pindah"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Desa</title>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/css_kades/laporan.css">
</head>
<body>

<div class="container">

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Kades</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="penduduk.php">Penduduk</a></li>
        <li><a href="kelahiran.php">Kelahiran</a></li>
        <li><a href="kematian.php">Kematian</a></li>
        <li><a href="pindah.php">Perpindahan</a></li>
        <li class="active"><a href="laporan.php">Laporan</a></li>
    </ul>
    <a href="../auth/logout.php" class="logout">Logout</a>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <h1>Laporan Desa</h1>
        <div class="user-box">
            <i class="fa-solid fa-user"></i>
            <?= $_SESSION['username']; ?>
        </div>
    </div>

    <!-- HEADER LAPORAN -->
    <div class="report-header">
        <h2>Laporan Kependudukan Desa</h2>
        <p>Tanggal: <?= date('d M Y'); ?></p>

        <div class="actions">
            <a href="laporan_pdf.php" class="btn pdf">
                <i class="fa-solid fa-file-pdf"></i> Download PDF
            </a>

            <button onclick="window.print()" class="btn print">
                <i class="fa-solid fa-print"></i> Cetak
            </button>
        </div>
    </div>

    <!-- CARDS -->
    <div class="cards">
        <div class="card">
            <i class="fa-solid fa-users icon blue"></i>
            <h3>Total Penduduk</h3>
            <h2><?= $total_penduduk ?></h2>
        </div>

        <div class="card">
            <i class="fa-solid fa-baby icon green"></i>
            <h3>Kelahiran</h3>
            <h2><?= $total_kelahiran ?></h2>
        </div>

        <div class="card">
            <i class="fa-solid fa-cross icon red"></i>
            <h3>Kematian</h3>
            <h2><?= $total_kematian ?></h2>
        </div>

        <div class="card">
            <i class="fa-solid fa-right-left icon purple"></i>
            <h3>Perpindahan</h3>
            <h2><?= $total_pindah ?></h2>
        </div>
    </div>

</div>
</div>

</body>
</html>