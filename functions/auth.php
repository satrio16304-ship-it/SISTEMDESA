<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function redirect_login() {
    header("Location: ../index.php");
    exit;
}

function cek_login() {
    if (!isset($_SESSION['role'])) {
        redirect_login();
    }
}

function cek_admin() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        redirect_login();
    }
}

function cek_kades() {
    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'kades') {
        redirect_login();
    }
}