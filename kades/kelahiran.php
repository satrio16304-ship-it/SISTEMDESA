<?php
session_start();
require '../config/koneksi.php';
require '../functions/auth.php';

// Proteksi role
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kades') {
    header("Location: ../auth/login.php");
    exit;
}

// PENCARIAN
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

// QUERY DATA
$query = mysqli_query($conn, "
    SELECT * FROM kelahiran
    WHERE nama_bayi LIKE '%$cari%' 
    ORDER BY tanggal_lahir DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kelahiran</title>

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/css_kades/kelahiran.css">
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Kades</h2>

        <ul>
            <li><a href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="penduduk.php"><i class="fa-solid fa-users"></i> Penduduk</a></li>
            <li class="active"><a href="kelahiran.php"><i class="fa-solid fa-baby"></i> Kelahiran</a></li>
            <li ><a href="kematian.php"><i class="fa-solid fa-cross"></i> Kematian</a></li>
            <li><a href="pindah.php"><i class="fa-solid fa-right-left"></i> Perpindahan</a></li>
            <li><a href="laporan.php"><i class="fa-solid fa-file"></i> Laporan</a></li>
        </ul>

        <a href="../auth/logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <div class="topbar">
            <h1>Data Kelahiran</h1>

            <div class="user-box">
                <i class="fa-solid fa-user"></i>
                <span><?= $_SESSION['username']; ?></span>
            </div>
        </div>

        <p class="subtitle"></p>

        <!-- SEARCH -->
        <form method="GET" class="search-box">
            <input type="text" name="cari" placeholder="Cari nama bayi..." value="<?= $cari ?>">
            <button type="submit"><i class="fa-solid fa-search"></i></button>
        </form>

        <!-- TABLE -->
        <div class="table-box">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Bayi</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama Ayah</th>
                    <th>Nama Ibu</th>
                </tr>

                <?php $no=1; while($row = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_bayi'] ?></td>
                    <td><?= date('d M Y', strtotime($row['tanggal_lahir'])) ?></td>
                    <td><?= $row['jenis_kelamin'] ?></td>
                    <td><?= $row['nama_ayah'] ?></td>
                    <td><?= $row['nama_ibu'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    </div>

</div>

</body>
</html>