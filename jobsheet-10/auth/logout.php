<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hapus cookie remember_user dengan memundurkan waktu kedaluwarsanya
if (isset($_COOKIE['remember_user'])) {
    setcookie('remember_user', '', time() - 3600, "/");
}

session_destroy();
header('Location: login.php');
exit;
