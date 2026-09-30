<?php
$host = "localhost";
$port = "5432";
$db   = "halo_premium"; 
$user = "postgres";         // Username default postgres
$pass = "12345678";     

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}