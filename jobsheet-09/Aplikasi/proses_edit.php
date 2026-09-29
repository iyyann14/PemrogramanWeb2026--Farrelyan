<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
$nama_aplikasi = trim($_POST['nama_aplikasi'] ?? '');
$developer = trim($_POST['developer'] ?? '');
$tahun_rilis = $_POST['tahun_rilis'] ?? '';
$versi = trim($_POST['versi'] ?? '');
$ukuran_mb = $_POST['ukuran_mb'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($nama_aplikasi === '') {
    $errors[] = "Nama aplikasi wajib diisi.";
}
if ($developer === '') {
    $errors[] = "Developer wajib diisi.";
}
if (!is_numeric($tahun_rilis) || $tahun_rilis < 1990 || $tahun_rilis > 2026) {
    $errors[] = "Tahun harus di antara 1990-2026.";
}
if (!is_numeric($ukuran_mb) || $ukuran_mb < 0) {
    $errors[] = "Ukuran MB tidak boleh negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE aplikasi SET nama_aplikasi = :nama_aplikasi, developer = :developer, tahun_rilis = :tahun_rilis, versi = :versi, ukuran_mb = :ukuran_mb, kategori = :kategori WHERE id = :id"
);
$stmt->execute([
    'nama_aplikasi' => $nama_aplikasi,
    'developer' => $developer,
    'tahun_rilis' => (int) $tahun_rilis,
    'versi' => $versi,
    'ukuran_mb' => (int) $ukuran_mb,
    'kategori' => $kategori,
    'id' => $id,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Aplikasi berhasil diperbarui.'];
header('Location: list.php');
exit;
