<?php
$page_title = "Tambah Aplikasi";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Tambah Aplikasi Baru</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <form id="form-tambah" method="post" action="proses_tambah.php">
        <p>
            <label for="kode_app">Kode App</label><br>
            <input type="text" id="kode_app" name="kode_app" placeholder="Contoh: APP001" required>
        </p>
        <p>
            <label for="nama_app">Nama Aplikasi</label><br>
            <input type="text" id="nama_app" name="nama_app" placeholder="Contoh: KasirKu Pro" required>
        </p>
        <p>
            <label for="kategori">Kategori</label><br>
            <select id="kategori" name="kategori">
                <option value="7 Hari">7 Hari</option>
                <option value="1 Bulan">1 Bulan</option>
                <option value="6 Bulan">6 Bulan</option>
                <option value="1 Tahun">1 Tahun</option>
                <option value="Seumur Hidup">Seumur Hidup</option>
            </select>
        </p>
        <p>
            <label for="harga">Harga (Rp)</label><br>
            <input type="number" id="harga" name="harga" min="0" placeholder="100000" required>
        </p>
        <p>
            <label for="deskripsi">Deskripsi Singkat</label><br>
            <input type="text" id="deskripsi" name="deskripsi" placeholder="Fitur unggulan aplikasi...">
        </p>
        <p>
            <button type="submit">Simpan Aplikasi</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>