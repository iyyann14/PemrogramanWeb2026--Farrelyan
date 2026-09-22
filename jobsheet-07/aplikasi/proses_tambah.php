<?php
session_start();

$kodeApp = trim($_POST['kode_app'] ?? '');
$namaApp = trim($_POST['nama_app'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = $_POST['harga'] ?? '';
$deskripsi = trim($_POST['deskripsi'] ?? '');

$errors = [];

if ($kodeApp === '') {
    $errors[] = "Kode App wajib diisi.";
}
if ($namaApp === '') {
    $errors[] = "Nama Aplikasi wajib diisi.";
}
if (!is_numeric($harga) || $harga < 0) {
    $errors[] = "Harga harus diisi dengan angka positif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['aplikasi'])) {
    $_SESSION['aplikasi'] = [];
}

$_SESSION['aplikasi'][] = [
    'kode_app' => $kodeApp,
    'nama_app' => $namaApp,
    'kategori' => $kategori,
    'harga' => (int) $harga,
    'deskripsi' => $deskripsi,
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Aplikasi berhasil ditambahkan.'];
header('Location: list.php');
exit;
