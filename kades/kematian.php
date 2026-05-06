<?php
session_start();
require '../config/koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kades') {
    header("Location: ../auth/login.php");
    exit;
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

$query = mysqli_query($conn, "
SELECT k.*, p.nama 
FROM kematian k
JOIN penduduk p ON k.id_penduduk = p.id_penduduk
WHERE p.nama LIKE '%$cari%'
ORDER BY k.tanggal_kematian DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kematian</title>
    <link rel="stylesheet" href="../assets/css/css_kades/kematian.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="container">
<div class="sidebar">
    <h2>Kades</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="penduduk.php">Penduduk</a></li>
        <li><a href="kelahiran.php">Kelahiran</a></li>
        <li class="active"><a href="kematian.php">Kematian</a></li>
        <li><a href="pindah.php">Perpindahan</a></li>
        <li><a href="laporan.php">Laporan</a></li>
    </ul>
    <a href="../auth/logout.php" class="logout">Logout</a>
</div>

<div class="main">
    <div class="topbar">
        <h1>Data Kematian</h1>
        <div class="user-box"><?= $_SESSION['username']; ?></div>
    </div>

    <form method="GET" class="search-box">
        <input type="text" name="cari" placeholder="Cari nama..." value="<?= $cari ?>">
        <button><i class="fa fa-search"></i></button>
    </form>

    <div class="table-box">
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Penyebab</th>
            </tr>

            <?php $no=1; while($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= date('d M Y', strtotime($row['tanggal_kematian'])) ?></td>
                <td><?= $row['penyebab'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</div>
</div>

</body>
</html>