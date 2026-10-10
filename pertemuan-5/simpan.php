<?php
include "koneksi.php";

$nim = $_POST['nim'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$prodi = $_POST['prodi'];
$angkatan = $_POST['angkatan'];
$ipk = $_POST['ipk'];

if ($ipk < 0 || $ipk > 4.00) {
    echo "Data gagal disimpan: Nilai IPK harus berada di rentang 0.00 hingga 4.00!";
    exit(); 
}

$query = mysqli_query(
    $koneksi, 
    "INSERT INTO mahasiswa 
    (nim, nama, email, prodi, angkatan, ipk) 
    VALUES 
    ('$nim', '$nama', '$email', '$prodi', '$angkatan', '$ipk')");

if ($query) {
    echo "Data berhasil disimpan.";
} else {
    echo "Data gagal disimpan.";
}
?>