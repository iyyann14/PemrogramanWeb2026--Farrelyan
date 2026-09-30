<?php
// Wajibkan login sebelum mengakses halaman Beranda/Dashboard
require __DIR__ . '/includes/auth.php';

$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

try {
    $totalAplikasi = $pdo->query("SELECT COUNT(*) FROM aplikasi")->fetchColumn();
    $totalPelanggan = $pdo->query("SELECT COUNT(*) FROM pelanggan")->fetchColumn();
    $totalKategori = $pdo->query("SELECT COUNT(*) FROM kategori")->fetchColumn();
} catch (PDOException $e) {
    $totalAplikasi = 0;
    $totalPelanggan = 0;
    $totalKategori = 0;
}
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
        <h3>Total Kategori</h3>
        <p><?php echo $totalKategori; ?></p>
    </article>
    <article>
        <h3>Transaksi Hari Ini</h3>
        <p>0</p>
    </article>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>