<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Edit Aplikasi";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM aplikasi WHERE id = :id");
$stmt->execute(['id' => $id]);
$aplikasi = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$aplikasi) {
    header('Location: list.php');
    exit;
}
?>
<section>
    <h2>Edit Aplikasi</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <form id="form-tambah" class="form-edit" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo $aplikasi['id']; ?>">
        <p>
            <label for="kode_app">Kode App</label><br>
            <input type="text" id="kode_app" name="kode_app" value="<?php echo htmlspecialchars($aplikasi['kode_app']); ?>" required>
        </p>
        <p>
            <label for="nama_app">Nama Aplikasi</label><br>
            <input type="text" id="nama_app" name="nama_app" value="<?php echo htmlspecialchars($aplikasi['nama_app']); ?>" required>
        </p>
        <p>
            <label for="kategori">Kategori</label><br>
            <select id="kategori" name="kategori">
                <?php
                $opsi_kategori = ['7 Hari', '1 Bulan', '6 Bulan', '1 Tahun', 'Seumur Hidup'];
                foreach ($opsi_kategori as $opsi):
                ?>
                    <option value="<?php echo $opsi; ?>" <?php echo $aplikasi['kategori'] === $opsi ? 'selected' : ''; ?>><?php echo $opsi; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="harga">Harga (Rp)</label><br>
            <input type="number" id="harga" name="harga" min="0" value="<?php echo htmlspecialchars($aplikasi['harga']); ?>" required>
        </p>
        <p>
            <label for="deskripsi">Deskripsi Singkat</label><br>
            <input type="text" id="deskripsi" name="deskripsi" value="<?php echo htmlspecialchars($aplikasi['deskripsi']); ?>">
        </p>
        <p>
            <button type="submit">Update</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>