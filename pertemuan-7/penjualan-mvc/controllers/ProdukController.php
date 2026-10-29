<?php
include "models/ProdukModel.php";

class ProdukController
{
    private $model;

    public function __construct($koneksi)
    {
        $this->model = new ProdukModel($koneksi);
    }

    public function index()
    {
        $produk = $this->model->getAllProduk();
        include "views/produk/index.php";
    }
}
?>