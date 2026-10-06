<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

// Validasi Kontrol Akses: Hanya Admin yang boleh menghapus data
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Akses ditolak! Hanya Admin yang diizinkan menghapus data kategori.'
    ];
    header('Location: list.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM kategori WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Kategori berhasil dihapus.'];
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menghapus kategori.'];
    }
}
header('Location: list.php');
exit;
