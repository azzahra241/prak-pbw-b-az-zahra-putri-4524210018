<?php

use Random\Engine;

require_once 'koneksi.php';

$sqlCreateDB = "CREATE DATABASE IF NOT EXISTS akademik";

if (mysqli_query($koneksi, $sqlCreateDB)) {
    echo "Database berhasil dibuat atau sudah ada.\n";
} else {
    echo "Error membuat database: " . mysqli_error($koneksi) . "\n";
}

mysqli_set_charset($koneksi, 'utf8mb4');

mysqli_select_db($koneksi, 'akademik');

$sqlCreateDBTables = [
    "CREATE TABLE IF NOT EXISTS mahasiswa (
        id BIGINT unsigned AUTO_INCREMENT PRIMARY KEY,
        nim VARCHAR(15) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        prodi VARCHAR(50) NOT NULL,
        angkatan YEAR NOT NULL,
        ipk DECIMAL(3, 2) default 0.00
    ) Engine=InnoDB",

    "CREATE TABLE IF NOT EXISTS dosen (
        id BIGINT unsigned AUTO_INCREMENT PRIMARY KEY,
        nidn VARCHAR(15) NOT NULL UNIQUE,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
    ) Engine=InnoDB",

    "CREATE TABLE IF NOT EXISTS matakuliah (
        id BIGINT unsigned AUTO_INCREMENT PRIMARY KEY,
        kode_mk VARCHAR(15) NOT NULL UNIQUE,
        nama_mk VARCHAR(100) NOT NULL,
        sks tinyint unsigned NOT NULL,
        dosen_id BIGINT unsigned,
        constraint fk_mk_dosen FOREIGN KEY (dosen_id) REFERENCES dosen(id) ON update CASCADE ON DELETE 
    ) Engine=InnoDB",
];

foreach ($sqlCreateDBTables as $namaTabel => $query) {
    if (mysqli_query($koneksi, $query)) {
        echo "Tabel berhasil dibuat atau sudah ada.\n";
    } else {
        echo "Error membuat tabel: " . mysqli_error($koneksi) . "\n";
    }
}

mysqli_close($koneksi);
?>