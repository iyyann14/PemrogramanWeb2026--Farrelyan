<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

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

try {
    $stmt = $pdo->prepare(
        "INSERT INTO pelanggan (id_pelanggan, nama, kota, no_hp)
         VALUES (:id_pelanggan, :nama, :kota, :no_hp)
         RETURNING id"
    );

    $stmt->execute([
        'id_pelanggan' => $idPelanggan,
        'nama'         => $nama,
        'kota'         => $kota,
        'no_hp'        => $noHp
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Pelanggan berhasil didaftarkan.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    // Cek apakah error disebabkan oleh pelanggaran UNIQUE constraint (kode 23505)
    if ($e->getCode() == '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID Pelanggan "' . htmlspecialchars($idPelanggan) . '" Sudah Digunakan. Silakan Gunakan ID Lain.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menyimpan: ' . $e->getMessage()];
    }
    header('Location: tambah.php');
    exit;
}
