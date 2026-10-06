<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika session belum ada, tapi cookie "remember_user" tersedia di browser
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_user'])) {
    require __DIR__ . '/koneksi.php';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $_COOKIE['remember_user']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Pulihkan kembali session secara otomatis
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];
    }
}

// Guard clause utama pengaman halaman
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
