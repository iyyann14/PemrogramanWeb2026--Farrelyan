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

    <!-- Action tetap ke proses_tambah.php milik buku -->
    <form id="form-tambah" method="post" action="proses_tambah.php">
        <p>
            <label for="judul">Nama Aplikasi</label><br>
            <input type="text" id="judul" name="judul" placeholder="Contoh: Canva Pro" required>
        </p>
        <p>
            <label for="pengarang">Developer</label><br>
            <input type="text" id="pengarang" name="pengarang" placeholder="Nama developer/perusahaan" required>
        </p>
        <p>
            <label for="tahun">Tahun Rilis</label><br>
            <input type="number" id="tahun" name="tahun" min="1900" max="2026" required>
        </p>
        <p>
            <label for="isbn">Kode App</label><br>
            <input type="text" id="isbn" name="isbn" placeholder="Contoh: APP001">
        </p>
        <p>
            <label for="stok">Stok Lisensi</label><br>
            <input type="number" id="stok" name="stok" min="0" required>
        </p>
        <p>
            <label for="kategori">Durasi / Paket</label><br>
            <select id="kategori" name="kategori">
                <option value="1 Bulan">1 Bulan</option>
                <option value="6 Bulan">6 Bulan</option>
                <option value="1 Tahun">1 Tahun</option>
                <option value="Seumur Hidup">Seumur Hidup</option>
            </select>
        </p>
        <p>
            <button type="submit">Simpan Aplikasi</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>