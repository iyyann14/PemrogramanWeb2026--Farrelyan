<?php
$page_title = "Daftar Aplikasi";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 10;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM aplikasi WHERE nama_app ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM aplikasi WHERE nama_app ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM aplikasi")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM aplikasi ORDER BY id DESC LIMIT :limit OFFSET :offset");
}

$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarAplikasi = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
<section>
    <h2>Daftar Aplikasi</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <div class="search-box">
        <form method="get" action="list.php">
            <span>
                <label for="search-input">Cari Nama Aplikasi</label><br>
                <input type="text" id="search-input" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Ketik nama aplikasi...">
            </span>
            <button type="submit">Cari</button>
        </form>
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
                        <td colspan="6">Tidak ada data aplikasi.</td>
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
                                <a href="edit.php?id=<?php echo $app['id']; ?>" class="btn-edit">Edit</a>
                                <form class="form-hapus" method="post" action="hapus.php">
                                    <input type="hidden" name="id" value="<?php echo $app['id']; ?>">
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