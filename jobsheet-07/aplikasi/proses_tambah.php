<?php
session_start();

$kodeApp = trim($_POST['kode_app'] ?? '');
$namaApp = trim($_POST['nama_app'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$harga = $_POST['harga'] ?? '';
$deskripsi = trim($_POST['deskripsi'] ?? '');

$errors = [];

// Validasi Kode App Menggunakan preg_match ide latihan 1
if ($kodeApp === '') {
    $errors[] = "Kode App Wajib Diisi";
} else if (!preg_match('/^[a-zA-Z0-9-]+$/', $kodeApp)) {
    $errors[] = "Kode App Hanya Boleh Berisi Huruf, Angka, dan Tanda Hubung";
}

// Validasi Nama Aplikasi
if ($namaApp === '') {
    $errors[] = "Nama Aplikasi Wajib Diisi";
}

// Validasi Harga
if (!is_numeric($harga) || $harga < 0) {
    $errors[] = "Harga Harus Diisi Dengan Angka Positif";
}

// Jika Error
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode('<br>', $errors)];
    header('Location: tambah.php');
    exit;
}

// Jika Lolos
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
