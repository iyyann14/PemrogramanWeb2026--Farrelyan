CREATE TABLE transaksi (
    id SERIAL PRIMARY KEY,
    aplikasi_id INTEGER NOT NULL REFERENCES aplikasi(id) ON DELETE CASCADE,
    pelanggan_id INTEGER NOT NULL REFERENCES pelanggan(id) ON DELETE CASCADE,
    tanggal_transaksi DATE NOT NULL DEFAULT CURRENT_DATE,
    tanggal_berakhir DATE, -- Kosong (NULL) jika Seumur Hidup
    status VARCHAR(20) NOT NULL DEFAULT 'aktif'
);