<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: ../admin/dashboard.php");
        exit;
    } else {
        header("Location: ../kades/dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Kependudukan Desa</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>

<div class="container">

    <div class="login-box">
        <h2>Login</h2>

        <!-- ERROR -->
        <?php if (isset($_GET['error'])): ?>
            <p class="error">Username atau Password salah!</p>
        <?php endif; ?>

        <form action="proses_login.php" method="POST">

            <!-- USERNAME -->
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan Username Anda" required>
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password Anda" required>
            </div>

            <!-- ROLE (REVISI RADIO MODERN) -->
            <div class="input-group">
                <label>Login Sebagai</label>

                <div class="role-group">
                    <input type="radio" id="admin" name="role" value="admin" required>
                    <label for="admin">Admin</label>

                    <input type="radio" id="kades" name="role" value="kades">
                    <label for="kades">Kepala Desa</label>
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="btn">Login</button>

            <!-- REGISTER -->
            <div class="register">
                <p>Belum punya akun? <a href="register.php">Daftar</a></p>
            </div>

        </form>
    </div>

</div>

</body>
</html>