<?php
$host = "localhost";
$port = "5432";
$db   = "jobsheet_11";
$user = "postgres";
$pass = "12345678";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Koneksi database gagal: " . $e->getMessage());
    http_response_code(500);
    die("Maaf, terjadi kesalahan pada sistem koneksi database.");
}
