<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/auth.php'; ?>

$id = $_POST['id'] ?? null;
$kodeApp = trim($_POST['kode_app'] ?? '');
$namaApp = trim($_POST['nama_app'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = $_POST['harga'] ?? '';
$deskripsi = trim($_POST['deskripsi'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($kodeApp === '') $errors[] = "Kode App wajib diisi.";
if ($namaApp === '') $errors[] = "Nama Aplikasi wajib diisi.";
if (!is_numeric($harga) || $harga < 0) $errors[] = "Harga harus diisi angka positif.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE aplikasi SET kode_app = :kode_app, nama_app = :nama_app, kategori = :kategori, harga = :harga, deskripsi = :deskripsi WHERE id = :id"
    );
    $stmt->execute([
        'kode_app'  => $kodeApp,
        'nama_app'  => $namaApp,
        'kategori'  => $kategori,
        'harga'     => (float) $harga,
        'deskripsi' => $deskripsi,
        'id'        => $id
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Aplikasi berhasil diperbarui.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() == '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Kode App "' . htmlspecialchars($kodeApp) . '" Sudah Digunakan.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mengupdate: ' . $e->getMessage()];
    }
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}