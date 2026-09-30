<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../includes/koneksi.php';

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    // Jika checkbox "Ingat Saya" dicentang
    if (isset($_POST['remember'])) {
        // Set cookie selama 30 hari (86400 detik * 30 hari)
        // Parameter: nama_cookie, nilai, waktu_kedaluwarsa, path, domain, secure, httponly
        setcookie('remember_user', $user['id'], time() + (86400 * 30), "/", "", false, true);
    }

    header('Location: ../index.php');
    exit;
}

$_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username atau password salah.'];
header('Location: login.php');
exit;
