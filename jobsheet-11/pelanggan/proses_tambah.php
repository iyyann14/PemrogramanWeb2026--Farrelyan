<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$noPelanggan = trim($_POST['no_pelanggan'] ?? '');
$email = trim($_POST['email'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($noPelanggan === '') {
    $errors[] = "No. Pelanggan wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO pelanggan (nama, no_pelanggan, email, no_hp)
      VALUES (:nama, :no_pelanggan, :email, :no_hp)
      RETURNING id"
);
$stmt->execute([
    'nama' => $nama,
    'no_pelanggan' => $noPelanggan,
    'email' => $email,
    'no_hp' => $noHp,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Pelanggan berhasil ditambahkan.'];
header('Location: list.php');
exit;
