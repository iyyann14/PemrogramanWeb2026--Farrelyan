<?php
session_start();

$idPelanggan = trim($_POST['id_pelanggan'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$kota = trim($_POST['kota'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];

if ($idPelanggan === '') {
    $errors[] = "ID Pelanggan wajib diisi.";
}
if ($nama === '') {
    $errors[] = "Nama Lengkap wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['pelanggan'])) {
    $_SESSION['pelanggan'] = [];
}

$_SESSION['pelanggan'][] = [
    'id_pelanggan' => $idPelanggan,
    'nama' => $nama,
    'kota' => $kota,
    'no_hp' => $noHp,
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Pelanggan berhasil didaftarkan.'];
header('Location: list.php');
exit;
