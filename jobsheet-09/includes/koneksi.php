<?php
$host = "ep-empty-mouse-b5g0jwql-pooler.c-7.us-east-2.aws.neon.tech"; // Diambil dari bagian @
$port = "5432";
$db   = "neondb";       // Nama database sesuai di neon.tech
$user = "neondb_owner"; // Nama role/user 
$pass = "npg_5ECGdAU3Xgzx"; // Sesuai dengan neodbowner

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
