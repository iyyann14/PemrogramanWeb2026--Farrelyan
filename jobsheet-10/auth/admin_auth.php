<?php
// Pastikan guard autentikasi utama sudah berjalan sebelumnya
require_once __DIR__ . '/auth.php'; // Menggunakan require_once yang benar di PHP

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah role pengguna saat ini adalah 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Akses ditolak! Fitur ini hanya dapat diakses oleh Admin.'
    ];
    header('Location: list.php');
    exit;
}
