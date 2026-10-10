<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus cookie remember_user jika ada
if (isset($_COOKIE['remember_user'])) {
    setcookie('remember_user', '', time() - 3600, "/");
}

// Hancurkan semua data session
session_destroy();

// Arahkan kembali ke halaman login
header('Location: login.php');
exit;
