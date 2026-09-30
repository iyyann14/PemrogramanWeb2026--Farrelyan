<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Daftar Kategori";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM kategori WHERE nama_kategori ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM kategori WHERE nama_kategori ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM kategori")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM kategori ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarKategori = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
<section>
    <h2>Daftar Kategori</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <div class="search-box">
        <form method="get" action="list.php">
            <span>
                <label for="search-input">Cari Nama Kategori</label><br>
                <input type="text" id="search-input" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Ketik nama kategori...">
            </span>
            <button type="submit">Cari</button>
        </form>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarKategori)): ?>
                    <tr>
                        <td colspan="4">Tidak ada data kategori yang cocok.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarKategori as $kat): ?>
                        <tr>
                            <td><?php echo $kat['id']; ?></td>
                            <td><?php echo htmlspecialchars($kat['nama_kategori']); ?></td>
                            <td><?php echo htmlspecialchars($kat['keterangan']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $kat['id']; ?>" class="btn-edit">Edit</a>
                                <form class="form-hapus" method="post" action="hapus.php">
                                    <input type="hidden" name="id" value="<?php echo $kat['id']; ?>">
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <nav class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </nav>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>