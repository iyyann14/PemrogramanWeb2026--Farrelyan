# Wireframe & User Flow - Toko Aplikasi Premium

Sub-CPMK: Merancang UI/UX aplikasi (proyek).

## Aktor
- **Pelanggan/Tamu**: Hanya bisa melihat katalog aplikasi (Beranda, Data Aplikasi) tanpa login.
- **Admin**: Login untuk mengakses seluruh fitur CRUD (Aplikasi & Pelanggan) dan manajemen transaksi/penjualan.

## User Flow - Pembelian Aplikasi (Tamu/Pelanggan)
[Beranda/Katalog] -> [Detail Aplikasi] -> [Pilih Metode Pembayaran]
        -> [Checkout] -> [Aplikasi Ditambahkan ke Library / Link Dikirim] -> [Selesai]

## User Flow - Manajemen Aplikasi (Admin)
[Admin Login] -> [Dashboard] -> [Menu "Tambah Aplikasi"]
        -> [Isi Form & Unggah File/Aset] -> [Simpan] 
        -> [Aplikasi Tampil di Katalog] -> [Kembali ke Dashboard]

## Wireframe: Halaman Login Admin
+--------------------------------------+
|        Toko Aplikasi Premium         |
|--------------------------------------|
|                                      |
|           [ Login Admin ]            |
|                                      |
|   Username : [______________]        |
|   Password : [______________]        |
|                                      |
|          [   Masuk   ]               |
|                                      |
|   Belum punya akun? Daftar di sini   |
+--------------------------------------+

## Wireframe: Dashboard Admin
+-----------------------------------------------------------------------+
| Toko Aplikasi Premium   Beranda | Aplikasi | Pelanggan | (Admin) Logout |
|-----------------------------------------------------------------------|
|  [Total Aplikasi]      [Total Pelanggan]      [Transaksi Hari Ini]    |
|                                                                       |
|  Aksi Cepat:                                                          |
|  [ + Aplikasi Baru ]   [ + Pelanggan Baru ]   [ + Proses Transaksi ]  |
|                                                                       |
|  Transaksi Terbaru                                                    |
|  --------------------------------------------------                   |
|  Pelanggan | Aplikasi   | Tgl Beli | Status                           |
|  Reza P.   | Capcut Pro | 13/10    | Sukses                           |
+-----------------------------------------------------------------------+

## Wireframe: Form Checkout / Transaksi Baru (Admin)
+--------------------------------------+
|  Form Pembelian Aplikasi             |
|--------------------------------------|
|  Pelanggan : [ dropdown pelanggan ]  |
|  Aplikasi  : [ dropdown app ready ]  |
|  Tanggal   : [ auto: hari ini ]      |
|                                      |
|          [  Proses Transaksi  ]      |
+--------------------------------------+