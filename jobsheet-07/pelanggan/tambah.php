<?php
$page_title = "Tambah Pelanggan";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Registrasi Pelanggan Baru</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <form id="form-tambah" method="post" action="proses_tambah.php">
        <p>
            <label for="nama">Nama Lengkap</label><br>
            <input type="text" id="nama" name="nama" placeholder="Nama lengkap pelanggan" required>
        </p>
        <p>
            <label for="no_anggota">ID Pelanggan</label><br>
            <input type="text" id="no_anggota" name="no_anggota" placeholder="Contoh: CUST-001" required>
        </p>
        <p>
            <label for="alamat">Kota Domisili</label><br>
            <input type="text" id="alamat" name="alamat" placeholder="Contoh: Jakarta">
        </p>
        <p>
            <label for="no_hp">No. WhatsApp</label><br>
            <input type="text" id="no_hp" name="no_hp" placeholder="08xxxxxxxxxx">
        </p>
        <p>
            <button type="submit">Daftarkan Pelanggan</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>