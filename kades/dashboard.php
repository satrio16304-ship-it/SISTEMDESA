<?php
session_start();
require '../config/koneksi.php';
require '../functions/auth.php';

// Proteksi role
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kades') {
    header("Location: ../auth/login.php");
    exit;
}

// DATA STATISTIK
$total_penduduk  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM penduduk"))['total'];
$total_kelahiran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kelahiran"))['total'];
$total_kematian  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM kematian"))['total'];
$total_pindah    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM pindah"))['total'];

// DATA GENDER
$laki = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM penduduk WHERE jenis_kelamin='Laki-laki'"))['total'];
$perempuan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM penduduk WHERE jenis_kelamin='Perempuan'"))['total'];

$total = $laki + $perempuan;
$persen_laki = $total > 0 ? ($laki / $total) * 100 : 0;
$persen_perempuan = $total > 0 ? ($perempuan / $total) * 100 : 0;

// DATA TERBARU
$data_terbaru = mysqli_query($conn, "
    SELECT 'Penduduk' as jenis, nama, tanggal_lahir as tanggal FROM penduduk
    UNION
    SELECT 'Kelahiran', nama_bayi, tanggal_lahir FROM kelahiran
    UNION
    SELECT 'Kematian', id_penduduk, tanggal_kematian FROM kematian
    UNION
    SELECT 'Pindah', id_penduduk, tanggal_pindah FROM pindah
    ORDER BY tanggal DESC
    LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Kades</title>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/css_kades/db_kades.css">
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Kepala Desa</h2>

        <ul>
    <li class="active">
        <a href="dashboard.php">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>
    </li>

    <li>
        <a href="penduduk.php">
            <i class="fa-solid fa-users"></i> Penduduk
        </a>
    </li>

    <li>
        <a href="kelahiran.php">
            <i class="fa-solid fa-baby"></i> Kelahiran
        </a>
    </li>

    <li>
        <a href="kematian.php">
            <i class="fa-solid fa-cross"></i> Kematian
        </a>
    </li>

    <li>
        <a href="pindah.php">
            <i class="fa-solid fa-right-left"></i> Perpindahan
        </a>
    </li>

    <li>
        <a href="laporan.php">
            <i class="fa-solid fa-file"></i> Laporan
        </a>
    </li>
    
</ul>

        <a href="../auth/logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <h1>Sistem Kependudukan Desa</h1>

            <div class="user-box">
                <i class="fa-solid fa-user"></i>
                <span><?= $_SESSION['username']; ?></span>
            </div>
        </div>

        <p class="subtitle"></p>

        <!-- CARDS -->
         <div class="cards">

            <div class="card">
                <div class="card-content">
                    <div>
                        <h3>Total Penduduk</h3>
                        <h2><?= $total_penduduk ?></h2>
                    </div>
                    <div class="icon blue">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <div>
                        <h3>Kelahiran</h3>
                        <h2><?= $total_kelahiran ?></h2>
                    </div>
                    <div class="icon green">
                        <i class="fa-solid fa-baby"></i>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <div>
                        <h3>Kematian</h3>
                        <h2><?= $total_kematian ?></h2>
                    </div>
                    <div class="icon red">
                        <i class="fa-solid fa-cross"></i>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <div>
                        <h3>Perpindahan</h3>
                        <h2><?= $total_pindah ?></h2>
                    </div>
                    <div class="icon purple">
                        <i class="fa-solid fa-right-left"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- BAR CHART -->
        <div class="chart-box">
            <h3>Data Berdasarkan Jenis Kelamin</h3>

            <div class="bar-chart">

                <div class="bar-group">
                    <div class="bar-label">
                        <span>Laki-laki</span>
                        <span><?= round($persen_laki) ?>%</span>
                    </div>
                    <div class="bar-container">
                        <div class="bar male" style="width: <?= $persen_laki ?>%">
                            <?= $laki ?>
                        </div>
                    </div>
                </div>

                <div class="bar-group">
                    <div class="bar-label">
                        <span>Perempuan</span>
                        <span><?= round($persen_perempuan) ?>%</span>
                    </div>
                    <div class="bar-container">
                        <div class="bar female" style="width: <?= $persen_perempuan ?>%">
                            <?= $perempuan ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- TABLE -->
        <div class="table-box">
            <h3>Data Terbaru</h3>

            <table>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                </tr>

                <?php $no=1; while($row = mysqli_fetch_assoc($data_terbaru)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['jenis'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    </div>

</div>

</body>
</html>