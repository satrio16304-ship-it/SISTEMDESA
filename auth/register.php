<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Sistem Kependudukan Desa</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>

<div class="container">
    <div class="login-box">

        <h2>Register</h2>

        <form action="proses_register.php" method="POST">

            <!-- USERNAME -->
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan Username Anda" required>
            </div>

            <!-- EMAIL -->
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan Email Anda" required>
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan Password Anda" required>
            </div>

            <!-- ROLE -->
            <div class="input-group">
                <label>Daftar Sebagai</label>

                <div class="role-group">
                    <input type="radio" id="admin" name="role" value="admin" required>
                    <label for="admin">Admin</label>

                    <input type="radio" id="kades" name="role" value="kades">
                    <label for="kades">Kepala Desa</label>
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit" name="register" class="btn">Daftar</button>

            <!-- LOGIN LINK -->
            <div class="register">
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>

        </form>

    </div>
</div>

</body>
</html>