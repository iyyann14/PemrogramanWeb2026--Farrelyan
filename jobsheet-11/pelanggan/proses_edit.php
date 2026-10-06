<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
$nama = trim($_POST['nama'] ?? '');
$noPelanggan = trim($_POST['no_pelanggan'] ?? '');
$email = trim($_POST['email'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($noPelanggan === '') {
    $errors[] = "No. Pelanggan wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE pelanggan SET nama = :nama, no_pelanggan = :no_pelanggan, email = :email, no_hp = :no_hp WHERE id = :id"
);
$stmt->execute([
    'nama' => $nama,
    'no_pelanggan' => $noPelanggan,
    'email' => $email,
    'no_hp' => $noHp,
    'id' => $id,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Pelanggan berhasil diperbarui.'];
header('Location: list.php');
exit;
