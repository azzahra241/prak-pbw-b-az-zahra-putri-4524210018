<?php
include "koneksi.php";
include "controllers/ProdukController.php";

$controller = new ProdukController($koneksi);
$controller->index();
?>