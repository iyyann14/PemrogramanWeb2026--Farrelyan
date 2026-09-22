<?php
$page_title = "Data Aplikasi";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarAplikasi = $_SESSION['aplikasi'] ?? [];
?>
<section>
    <h2>Daftar Aplikasi</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <div class="search-box">
        <label for="search-input">Cari Nama Aplikasi</label>
        <input type="text" id="search-input" placeholder="Ketik nama aplikasi...">
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
                        <td colspan="6">Belum ada data aplikasi. Silakan tambah lewat menu "Tambah Aplikasi".</td>
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