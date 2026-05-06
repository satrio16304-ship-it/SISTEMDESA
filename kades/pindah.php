<?php
session_start();
require '../config/koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kades') {
    header("Location: ../auth/login.php");
    exit;
}

$cari = $_GET['cari'] ?? '';

$query = mysqli_query($conn, "
SELECT p.nama, pi.*
FROM pindah pi
JOIN penduduk p ON pi.id_penduduk = p.id_penduduk
WHERE p.nama LIKE '%$cari%'
ORDER BY pi.tanggal_pindah DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Perpindahan</title>
    <link rel="stylesheet" href="../assets/css/css_kades/pindah.css">
</head>
<body>

<div class="container">
<div class="sidebar">
    <h2>Kades</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="penduduk.php">Penduduk</a></li>
        <li><a href="kelahiran.php">Kelahiran</a></li>
        <li><a href="kematian.php">Kematian</a></li>
        <li class="active"><a href="pindah.php">Perpindahan</a></li>
        <li><a href="laporan.php">Laporan</a></li>
    </ul>
    <a href="../auth/logout.php" class="logout">Logout</a>
</div>

<div class="main">
    <div class="topbar">
        <h1>Data Perpindahan</h1>
        <div class="user-box"><?= $_SESSION['username']; ?></div>
    </div>

    <form method="GET" class="search-box">
        <input type="text" name="cari" placeholder="Cari nama..." value="<?= $cari ?>">
        <button>Cari</button>
    </form>

    <div class="table-box">
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Alasan</th>
                <th>Tujuan</th>
            </tr>

            <?php $no=1; while($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= date('d M Y', strtotime($row['tanggal_pindah'])) ?></td>
                <td><?= $row['alasan_pindah'] ?></td>
                <td><?= $row['alamat_tujuan'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</div>

</body>
</html>