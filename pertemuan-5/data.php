<?php
include "koneksi.php";

$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

while ($data = mysqli_fetch_assoc($query)) {
    echo $data['nim'];
    echo " - ";
    echo $data['nama'];
    $predikat = ($data['ipk'] >= 3.50) ? " (Cumlaude)" : " (Sangat Memuaskan)";
    echo $predikat;
    echo "<br>";
}
?>