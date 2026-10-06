<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Tambah Kategori";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Tambah Kategori Baru</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo e($flash['type']); ?>"><?php echo e($flash['pesan']); ?></p>
    <?php endif; ?>
    <form id="form-tambah" method="post" action="proses_tambah.php">
        <?php echo csrf_field(); ?>
        <p>
            <label for="nama_kategori">Nama Kategori</label><br>
            <input type="text" id="nama_kategori" name="nama_kategori" required>
        </p>
        <p>
            <label for="keterangan">Keterangan (Opsional)</label><br>
            <input type="text" id="keterangan" name="keterangan">
        </p>
        <p>
            <button type="submit">Simpan Kategori</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>