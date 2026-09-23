<?php
session_start();

// 1. Kosongkan Semua Data di Variabel $_SESSION
$_SESSION = [];

// 2. Hancurkan Session di Server
session_destroy();

// 3. Arahkan Kembali Pengguna ke Halaman Beranda
header('Location: index.php');
exit;