<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$nama_aplikasi = trim($_POST['nama_aplikasi'] ?? '');
$developer = trim($_POST['developer'] ?? '');
$tahun_rilis = $_POST['tahun_rilis'] ?? '';
$versi = trim($_POST['versi'] ?? '');
$ukuran_mb = $_POST['ukuran_mb'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

$errors = [];
if ($nama_aplikasi === '') $errors[] = "Nama aplikasi wajib diisi.";
if ($developer === '') $errors[] = "Developer wajib diisi.";
if (!is_numeric($tahun_rilis) || $tahun_rilis < 1990 || $tahun_rilis > 2026) $errors[] = "Tahun harus di antara 1990-2026.";
if (!is_numeric($ukuran_mb) || $ukuran_mb < 0) $errors[] = "Ukuran MB tidak boleh negatif.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO aplikasi (nama_aplikasi, developer, tahun_rilis, versi, ukuran_mb, kategori) 
     VALUES (:nama_aplikasi, :developer, :tahun_rilis, :versi, :ukuran_mb, :kategori) RETURNING id"
);
$stmt->execute([
    'nama_aplikasi' => $nama_aplikasi,
    'developer' => $developer,
    'tahun_rilis' => (int) $tahun_rilis,
    'versi' => $versi,
    'ukuran_mb' => (int) $ukuran_mb,
    'kategori' => $kategori,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Aplikasi berhasil ditambahkan.'];
header('Location: list.php');
exit;
