<?php
$page_title = "Tambah Aplikasi";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Tambah Aplikasi</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <form id="form-tambah" method="post" action="proses_tambah.php">
        <p>
            <label for="nama_aplikasi">Nama Aplikasi</label><br>
            <input type="text" id="nama_aplikasi" name="nama_aplikasi" required>
        </p>
        <p>
            <label for="developer">Developer</label><br>
            <input type="text" id="developer" name="developer" required>
        </p>
        <p>
            <label for="tahun_rilis">Tahun Rilis</label><br>
            <input type="number" id="tahun_rilis" name="tahun_rilis" min="1990" max="2026" required>
        </p>
        <p>
            <label for="versi">Versi</label><br>
            <input type="text" id="versi" name="versi">
        </p>
        <p>
            <label for="ukuran_mb">Ukuran (MB)</label><br>
            <input type="number" id="ukuran_mb" name="ukuran_mb" min="0" required>
        </p>
        <p>
            <label for="kategori">Kategori</label><br>
            <select id="kategori" name="kategori">
                <option value="games">Games</option>
                <option value="produktivitas">Produktivitas</option>
                <option value="utilitas">Utilitas</option>
            </select>
        </p>
        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>