<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role = trim($_POST['role'] ?? 'pelanggan'); // Mengambil role dari form, default ke 'pelanggan'

$errors = [];

if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($username === '') {
    $errors[] = "Username wajib diisi.";
}
if (strlen($password) < 6) {
    $errors[] = "Password minimal 6 karakter.";
}

// Validasi keamanan: pastikan role yang dikirimkan hanya 'pelanggan' atau 'admin'
$allowed_roles = ['pelanggan', 'admin'];
if (!in_array($role, $allowed_roles)) {
    $role = 'pelanggan'; // Fallback aman jika role dimanipulasi dari sisi klien
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

// Cek apakah username sudah terdaftar
$cek = $pdo->prepare("SELECT id FROM users WHERE username = :username");
$cek->execute(['username' => $username]);
if ($cek->fetch()) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah digunakan.'];
    header('Location: register.php');
    exit;
}

try {
    $stmt = $pdo->prepare(
        "INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)"
    );
    $stmt->execute([
        'nama' => $nama,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => $role
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil, silakan login.'];
    header('Location: login.php');
    exit;
} catch (PDOException $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal registrasi: ' . $e->getMessage()];
    header('Location: register.php');
    exit;
}
