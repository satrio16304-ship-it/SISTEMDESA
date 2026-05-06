<?php
require '../config/koneksi.php';

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = md5($_POST['password']);
    $role     = $_POST['role'];

$token = md5(rand());

mysqli_query($conn, "INSERT INTO users 
(username,email,password,role,status,token)
VALUES 
('$username','$email','$password','$role','tidak aktif','$token')");

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'satrio16304@gmail.com';
        $mail->Password   = 'fagtatjhgczhmjoh';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('satrio16304@gmail.com', 'Sistem Desa');
        $mail->addAddress($email);

        $link = "http://localhost/kependudukan_desa/auth/verifikasi.php?token=$token";

        $mail->isHTML(true);
        $mail->Subject = 'Verifikasi Akun';
        $mail->Body    = "Klik link berikut untuk verifikasi akun:<br><a href='$link'>$link</a>";

        $mail->send();

        echo "Registrasi berhasil! Cek email untuk verifikasi.";

    } catch (Exception $e) {
        echo "Email gagal dikirim. Error: {$mail->ErrorInfo}";
    }
}