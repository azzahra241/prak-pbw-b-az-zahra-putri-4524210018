<?php
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'akademik2';
$port = 3306;

$koneksi = mysqli_connect($host, $user, $password, '', $port);

if (!$koneksi) {
    die("koneksi gagal: " . mysqli_connect_error());
}

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS $dbname";
if (!mysqli_query($koneksi, $sqlCreateDB)) {
    die("gagal membuat database: " . mysqli_error($koneksi));
}

if (!mysqli_select_db($koneksi, $dbname)) {
    die("gagal memilih database $dbname: " . mysqli_error($koneksi));
}

mysqli_set_charset($koneksi, 'utf8mb4');

echo "koneksi ke server mysql berhasil! <br><br>";
?>