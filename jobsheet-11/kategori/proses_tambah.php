<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$namaKategori = trim($_POST['nama_kategori'] ?? '');
$keterangan = trim($_POST['keterangan'] ?? '');

$errors = [];
if ($namaKategori === '') {
    $errors[] = "Nama kategori wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO kategori (nama_kategori, keterangan) VALUES (:nama_kategori, :keterangan)"
    );
    $stmt->execute([
        'nama_kategori' => $namaKategori,
        'keterangan' => $keterangan
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Kategori berhasil ditambahkan.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() == '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Nama Kategori sudah ada. Silakan gunakan nama lain.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menyimpan: ' . $e->getMessage()];
    }
    header('Location: tambah.php');
    exit;
}
