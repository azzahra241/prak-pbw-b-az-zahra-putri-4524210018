<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'penjualan';
$port = 3306;

$koneksi = mysqli_connect($host, $user, $password, '', $port);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if (!mysqli_query($koneksi, $sqlCreateDB)) {
    die("Gagal membuat database: " . mysqli_error($koneksi));
}

if (!mysqli_select_db($koneksi, $dbname)) {
    die("Gagal memilih database $dbname: " . mysqli_error($koneksi));
}

$sqlCreateTable = "CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL
)";
mysqli_query($koneksi, $sqlCreateTable);

mysqli_set_charset($koneksi, 'utf8mb4');
?>