<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

$kodeApp = trim($_POST['kode_app'] ?? '');
$namaApp = trim($_POST['nama_app'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = $_POST['harga'] ?? '';
$deskripsi = trim($_POST['deskripsi'] ?? '');

$errors = [];
if ($kodeApp === '') $errors[] = "Kode App wajib diisi.";
if ($namaApp === '') $errors[] = "Nama Aplikasi wajib diisi.";
if (!is_numeric($harga) || $harga < 0) $errors[] = "Harga harus diisi angka positif.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO aplikasi (kode_app, nama_app, kategori, harga, deskripsi) 
         VALUES (:kode_app, :nama_app, :kategori, :harga, :deskripsi) 
         RETURNING id"
    );
    $stmt->execute([
        'kode_app'  => $kodeApp,
        'nama_app'  => $namaApp,
        'kategori'  => $kategori,
        'harga'     => (float) $harga,
        'deskripsi' => $deskripsi
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Aplikasi berhasil ditambahkan.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() == '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Kode App "' . htmlspecialchars($kodeApp) . '" Sudah Digunakan. Silakan Gunakan Kode Lain.'];
    } else {
        error_log($e->getMessage()); // Simpan log error secara diam-diam
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Maaf, terjadi kesalahan sistem saat menyimpan data.'];
    }
    header('Location: tambah.php');
    exit;
}
