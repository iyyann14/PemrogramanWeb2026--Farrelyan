<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

// === TAMBAHAN LATIHAN 1: BATASI HANYA UNTUK ADMIN ===
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Akses Ditolak! Hanya Admin yang Diizinkan Menghapus Data.'
    ];
    header('Location: list.php');
    exit;
}
// ====================================================

require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM aplikasi WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Aplikasi Berhasil Dihapus.'];
}

header('Location: list.php');
exit;
