<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Edit Pelanggan";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM pelanggan WHERE id = :id");
$stmt->execute(['id' => $id]);
$pelanggan = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pelanggan) {
    header('Location: list.php');
    exit;
}
?>
<section>
    <h2>Edit Pelanggan</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <form id="form-tambah" class="form-edit" method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo $pelanggan['id']; ?>">
        <p>
            <label for="nama">Nama Pelanggan</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($pelanggan['nama']); ?>" required>
        </p>
        <p>
            <label for="no_pelanggan">No. Pelanggan</label><br>
            <input type="text" id="no_pelanggan" name="no_pelanggan" value="<?php echo htmlspecialchars($pelanggan['no_pelanggan']); ?>" required>
        </p>
        <p>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($pelanggan['email']); ?>">
        </p>
        <p>
            <label for="no_hp">No. HP</label><br>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($pelanggan['no_hp']); ?>">
        </p>
        <p>
            <button type="submit">Update</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>