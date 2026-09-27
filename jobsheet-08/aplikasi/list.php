<?php
$page_title = "Data Aplikasi";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Menangkap kata kunci pencarian dari URL (jika ada)
$keyword = trim($_GET['q'] ?? '');

// Jika ada kata kunci, gunakan prepared statement dengan ILIKE
if ($keyword !== '') {
    $stmt = $pdo->prepare("SELECT * FROM aplikasi WHERE nama_app ILIKE :keyword ORDER BY id DESC");
    // Tambahkan tanda % di awal dan akhir keyword untuk pencarian sebagian kata (wildcard)
    $stmt->execute(['keyword' => '%' . $keyword . '%']);
    $daftarAplikasi = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Jika tidak ada pencarian, tampilkan semua data seperti biasa
    $daftarAplikasi = $pdo->query("SELECT * FROM aplikasi ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<section>
    <h2>Daftar Aplikasi</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <div class="search-box">
        <!-- Form GET untuk mengirimkan kata kunci pencarian ke server -->
        <form method="GET" action="">
            <label for="server-search">Cari Nama Aplikasi</label>
            <input type="text" name="q" id="server-search" placeholder="Ketik nama lalu tekan Enter..." value="<?php echo htmlspecialchars($keyword); ?>">
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Kode App</th>
                    <th>Nama Aplikasi</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarAplikasi)): ?>
                    <tr>
                        <td colspan="6">
                            <?php echo ($keyword !== '') ? 'Aplikasi tidak ditemukan.' : 'Belum ada data aplikasi. Silakan tambah lewat menu "Tambah Aplikasi".'; ?>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarAplikasi as $app): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($app['kode_app']); ?></td>
                            <td><?php echo htmlspecialchars($app['nama_app']); ?></td>
                            <td><?php echo htmlspecialchars($app['kategori']); ?></td>
                            <td>Rp <?php echo number_format($app['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($app['deskripsi']); ?></td>
                            <td>
                                <button type="button" class="btn-edit">Edit</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>