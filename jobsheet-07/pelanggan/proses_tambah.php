<?php
session_start();

$idPelanggan = trim($_POST['id_pelanggan'] ?? '');
$nama = trim($_POST['nama'] ?? '');
$kota = trim($_POST['kota'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];

// Validasi ID Pelanggan
if ($idPelanggan === '') {
    $errors[] = "ID Pelanggan wajib diisi.";
} elseif (!preg_match('/^[a-zA-Z0-9\-]+$/', $idPelanggan)) {
    $errors[] = "ID Pelanggan hanya boleh berisi huruf, angka, dan tanda hubung.";
}

// Validasi Nama Lengkap
if ($nama === '') {
    $errors[] = "Nama Lengkap wajib diisi.";
}

// Validasi No. WhatsApp (opsional)
if ($noHp !== '') {
    // Mengecek apakah hanya berisi angka dan panjangnya antara 10 hingga 15 digit
    if (!preg_match('/^[0-9]{10,15}$/', $noHp)) {
        $errors[] = "No. WhatsApp tidak valid. Harus berupa angka sepanjang 10-15 digit.";
    }
}

// Validasi Kota Domisili (opsional)
if ($kota !== '' && !preg_match('/^[a-zA-Z\s]+$/', $kota)) {
    $errors[] = "Kota Domisili hanya boleh berisi huruf dan spasi.";
}

// Jika Error
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

// Jika Lolos
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
