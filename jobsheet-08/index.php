<?php
require __DIR__ . '/includes/koneksi.php';
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';

$totalAplikasi = $pdo->query("SELECT COUNT(*) FROM aplikasi")->fetchColumn();
$totalPelanggan = $pdo->query("SELECT COUNT(*) FROM pelanggan")->fetchColumn();
?>

<section>
    <h2>Dashboard</h2>
    <p>Selamat Datang di Web Pengelola Data Penjualan Aplikasi</p>
</section>

<section>
    <h2>Statistik Penjualan</h2>
    <article>
        <h3>Total Aplikasi</h3>
        <p><?php echo $totalAplikasi; ?></p>
    </article>
    <article>
        <h3>Total Pelanggan</h3>
        <p><?php echo $totalPelanggan; ?></p>
    </article>
    <article>
        <h3>Transaksi Hari Ini</h3>
        <p>0</p>
    </article>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>