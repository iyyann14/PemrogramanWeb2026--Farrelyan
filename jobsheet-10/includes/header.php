<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

$sudahLogin = isset($_SESSION['user_id']);
$isAuthPage = strpos($_SERVER['SCRIPT_FILENAME'], '/auth/') !== false || strpos($_SERVER['SCRIPT_FILENAME'], '\auth\\') !== false;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Aplikasi Premium<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>

<body>
    <header>
        <div class="header-titles">
            <h1>Toko Aplikasi Premium</h1>
            <p>Web Pengelola Data Aplikasi Premium Online</p>
        </div>

        <?php if (!$isAuthPage): ?>
            <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
            <nav>
                <ul>
                    <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                    <li><a href="<?php echo $base; ?>aplikasi/list.php">Data Aplikasi</a></li>
                    <li><a href="<?php echo $base; ?>aplikasi/tambah.php">Tambah Aplikasi</a></li>
                    <li><a href="<?php echo $base; ?>pelanggan/list.php">Data Pelanggan</a></li>
                    <li><a href="<?php echo $base; ?>pelanggan/tambah.php">Tambah Pelanggan</a></li>
                    <li><a href="<?php echo $base; ?>kategori/list.php">Data Kategori</a></li>
                    <li><a href="<?php echo $base; ?>kategori/tambah.php">Tambah Kategori</a></li>
                </ul>
            </nav>

            <div class="auth-status">
                <?php if ($sudahLogin): ?>
                    <span>Halo, <?php echo htmlspecialchars($_SESSION['nama'] ?? 'User'); ?></span>
                    <a href="<?php echo $base; ?>auth/logout.php">Logout</a>
                <?php else: ?>
                    <a href="<?php echo $base; ?>auth/login.php">Login</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </header>
    <main>