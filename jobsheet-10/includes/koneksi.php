<?php
$host = "ep-weathered-sea-b4v6cs8c-pooler.c-6.us-east-2.aws.neon.tech";
$port = "5432";
$db   = "neondb";
$user = "neondb_owner";
$pass = "npg_TclSZ14eQzaJ";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=require";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database Neon gagal: " . $e->getMessage());
}