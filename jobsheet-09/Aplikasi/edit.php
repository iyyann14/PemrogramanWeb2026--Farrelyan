<?php
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
    <form id="form-tambah" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo $aplikasi['id']; ?>">
        <p>
            <label for="nama_aplikasi">Nama Aplikasi</label><br>
            <input type="text" id="nama_aplikasi" name="nama_aplikasi" value="<?php echo $aplikasi['nama_aplikasi']; ?>" required>
        </p>
        <p>
            <label for="developer">Developer</label><br>
            <input type="text" id="developer" name="developer" value="<?php echo $aplikasi['developer']; ?>" required>
        </p>
        <p>
            <label for="tahun_rilis">Tahun Rilis</label><br>
            <input type="number" id="tahun_rilis" name="tahun_rilis" min="1990" max="2026" value="<?php echo $aplikasi['tahun_rilis']; ?>" required>
        </p>
        <p>
            <label for="versi">Versi</label><br>
            <input type="text" id="versi" name="versi" value="<?php echo $aplikasi['versi']; ?>">
        </p>
        <p>
            <label for="ukuran_mb">Ukuran (MB)</label><br>
            <input type="number" id="ukuran_mb" name="ukuran_mb" min="0" value="<?php echo $aplikasi['ukuran_mb']; ?>" required>
        </p>
        <p>
            <label for="kategori">Kategori</label><br>
            <select id="kategori" name="kategori">
                <?php foreach (['games' => 'Games', 'produktivitas' => 'Produktivitas', 'utilitas' => 'Utilitas'] as $value => $label): ?>
                    <option value="<?php echo $value; ?>" <?php echo $aplikasi['kategori'] === $value ? 'selected' : ''; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <button type="submit">Update</button>
        </p>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>