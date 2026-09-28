CREATE TABLE IF NOT EXISTS aplikasi (
    id SERIAL PRIMARY KEY,
    nama_aplikasi VARCHAR(255) NOT NULL,
    developer VARCHAR(255) NOT NULL,
    tahun_rilis INTEGER NOT NULL,
    versi VARCHAR(50),
    ukuran_mb INTEGER NOT NULL DEFAULT 0,
    kategori VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS pelanggan (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    no_pelanggan VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255),
    no_hp VARCHAR(30)
);