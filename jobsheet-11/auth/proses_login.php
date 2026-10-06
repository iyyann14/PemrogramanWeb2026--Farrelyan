<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../includes/csrf.php';
require __DIR__ . '/../includes/koneksi.php';

// Verifikasi token CSRF dari form login
csrf_verify();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// Batas maksimal percobaan gagal
$maxAttempts = 3;

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = [];
}

$currentAttempts = $_SESSION['login_attempts'][$username] ?? 0;
if ($currentAttempts >= $maxAttempts) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Akun dengan username ini terkunci sementara karena terlalu banyak percobaan gagal. Silakan coba beberapa saat lagi.'
    ];
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Regenerasi session ID setelah login berhasil untuk mencegah Session Fixation
    session_regenerate_id(true);

    unset($_SESSION['login_attempts'][$username]);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];
    header('Location: ../index.php');
    exit;
} else {
    if (!isset($_SESSION['login_attempts'][$username])) {
        $_SESSION['login_attempts'][$username] = 0;
    }
    $_SESSION['login_attempts'][$username]++;
    $sisaKesempatan = $maxAttempts - $_SESSION['login_attempts'][$username];

    if ($sisaKesempatan > 0) {
        $pesanError = "Username atau password salah. Sisa kesempatan: {$sisaKesempatan} kali.";
    } else {
        $pesanError = "Anda telah gagal 3 kali. Akun terkunci sementara.";
    }

    $_SESSION['flash'] = ['type' => 'error', 'pesan' => $pesanError];
    header('Location: login.php');
    exit;
}
