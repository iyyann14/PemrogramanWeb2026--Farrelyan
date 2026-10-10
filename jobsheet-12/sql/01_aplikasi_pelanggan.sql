DROP TABLE IF EXISTS aplikasi;
CREATE TABLE aplikasi (
    id SERIAL PRIMARY KEY,
    kode_app VARCHAR(50) NOT NULL UNIQUE,
    nama_app VARCHAR(255) NOT NULL,
    kategori VARCHAR(50),
    harga NUMERIC(12, 2) NOT NULL DEFAULT 0,
    deskripsi TEXT
);

DROP TABLE IF EXISTS pelanggan;
CREATE TABLE pelanggan (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    no_pelanggan VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255),
    no_hp VARCHAR(30)
);

CREATE TABLE kategori (
    id SERIAL PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL UNIQUE,
    keterangan TEXT
);