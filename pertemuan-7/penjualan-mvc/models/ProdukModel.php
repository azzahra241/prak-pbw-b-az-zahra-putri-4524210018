<?php
class ProdukModel
{
    private $koneksi;

    public function __construct($koneksi)
    {
        $this->koneksi = $koneksi;
    }

    public function getAllProduk()
    {
        $query = mysqli_query($this->koneksi, "SELECT * FROM produk");
        return $query;
    }
}
?>