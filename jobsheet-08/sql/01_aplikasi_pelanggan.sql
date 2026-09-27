-- Jobsheet 8: Skema Toko Aplikasi Premium (PostgreSQL)
-- Jalankan setelah membuat database:
--   createdb toko_aplikasi
--   psql -d toko_aplikasi -f sql/01_aplikasi_pelanggan.sql

CREATE TABLE IF NOT EXISTS aplikasi (
    id SERIAL PRIMARY KEY,
    kode_app VARCHAR(50) NOT NULL UNIQUE,
    nama_app VARCHAR(255) NOT NULL,
    kategori VARCHAR(50),
    harga NUMERIC(12, 2) NOT NULL DEFAULT 0,
    deskripsi TEXT
);

CREATE TABLE IF NOT EXISTS pelanggan (
    id SERIAL PRIMARY KEY,
    id_pelanggan VARCHAR(50) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    kota VARCHAR(100),
    no_hp VARCHAR(30)
);