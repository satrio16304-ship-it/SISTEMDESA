<?php
session_start();
require '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if (!$query) {
    die("Query Error: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($query);

if ($data && $password == $data['password']) {

    $_SESSION['username'] = $data['username'];
    $_SESSION['role']     = $data['role'];

    if ($data['role'] == 'admin') {
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        header("Location: ../kades/dashboard.php");
        exit;
    }

} else {
    header("Location: login.php?error=1");
    exit;
}