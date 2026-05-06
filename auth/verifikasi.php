<?php
require '../config/koneksi.php';

if (isset($_GET['token'])) {

    $token = $_GET['token'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE token='$token'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        mysqli_query($conn, "UPDATE users SET status='aktif', token=NULL WHERE token='$token'");
        echo "Akun berhasil diverifikasi! <a href='login.php'>Login</a>";
    } else {
        echo "Token tidak valid!";
    }
}