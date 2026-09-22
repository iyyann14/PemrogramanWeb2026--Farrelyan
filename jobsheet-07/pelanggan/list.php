<?php
$page_title = "Data Pelanggan";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarPelanggan = $_SESSION['pelanggan'] ?? [];
?>
<section>
    <h2>Daftar Pelanggan Aktif</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>
    <div class="search-box">
        <label for="search-input">Cari Nama Pelanggan</label>
        <input type="text" id="search-input" placeholder="Ketik nama pelanggan...">
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Nama Lengkap</th>
                    <th>Kota Domisili</th>
                    <th>No. WhatsApp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarPelanggan)): ?>
                    <tr>
                        <td colspan="5">Belum ada data pelanggan. Silakan tambah lewat menu "Tambah Pelanggan".</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarPelanggan as $plg): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($plg['id_pelanggan']); ?></td>
                            <td><?php echo htmlspecialchars($plg['nama']); ?></td>
                            <td><?php echo htmlspecialchars($plg['kota']); ?></td>
                            <td><?php echo htmlspecialchars($plg['no_hp']); ?></td>
                            <td>
                                <button type="button" class="btn-edit">Edit</button>
                                <button type="button" class="btn-hapus">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>