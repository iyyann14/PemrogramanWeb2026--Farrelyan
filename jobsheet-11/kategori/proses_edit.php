<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

csrf_verify();

$id = $_POST['id'] ?? null;
$namaKategori = trim($_POST['nama_kategori'] ?? '');
$keterangan = trim($_POST['keterangan'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($namaKategori === '') {
    $errors[] = "Nama kategori wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

try {
    $stmt = $pdo->prepare(
        "UPDATE kategori SET nama_kategori = :nama_kategori, keterangan = :keterangan WHERE id = :id"
    );
    $stmt->execute([
        'nama_kategori' => $namaKategori,
        'keterangan' => $keterangan,
        'id' => $id
    ]);
    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Kategori berhasil diperbarui.'];
    header('Location: list.php');
    exit;
} catch (PDOException $e) {
    if ($e->getCode() == '23505') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Nama Kategori sudah digunakan.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mengupdate: ' . $e->getMessage()];
    }
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}
