<?php

// Base URL untuk link di view (otomatis deteksi host)
if (!defined('BASE_URL')) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
    define('BASE_URL', $scheme . '://' . $host);
}

// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_NAME', 'sklipci');
define('DB_USER', 'root');
define('DB_PASS', '');

// Helper koneksi (mysqli)
function db(): mysqli
{
    static $conn;

    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die('Koneksi database gagal: ' . $conn->connect_error);
        }
        $conn->set_charset('utf8mb4');
    }

    return $conn;
}
