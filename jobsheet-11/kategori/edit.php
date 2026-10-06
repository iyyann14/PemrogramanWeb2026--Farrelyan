<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Edit Kategori";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM kategori WHERE id = :id");
$stmt->execute(['id' => $id]);
$kategori = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$kategori) {
    header('Location: list.php');
    exit;
}
?>
<section>
    <h2>Edit Kategori</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <!-- Class form-edit ditambahkan untuk memicu konfirmasi JS -->
    <form id="form-tambah" class="form-edit" method="post" action="proses_edit.php">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo (int) $kategori['id']; ?>">
        <p>
            <label for="nama_kategori">Nama Kategori</label><br>
            <input type="text" id="nama_kategori" name="nama_kategori" value="<?php echo e($kategori['nama_kategori']); ?>" required>
        </p>
        <p>
            <label for="keterangan">Keterangan (Opsional)</label><br>
            <input type="text" id="keterangan" name="keterangan" value="<?php echo e($kategori['keterangan']); ?>">
        </p>
        <p>
            <button type="submit">Update Kategori</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>