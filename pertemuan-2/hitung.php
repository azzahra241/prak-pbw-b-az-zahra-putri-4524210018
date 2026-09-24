<?php

// MODIFIKASI 1: menambahkan class baru ProdukPPN (produk dengan pajak/PPN)
// MODIFIKASI 2: menambahkan validasi nilai diskon (0-100) + menghitung total keseluruhan

interface BisaDihitung
{
    public function hargaAkhir(): float;
}

class Produk implements BisaDihitung
{
    public function __construct(
        protected string $nama,
        protected float $harga
    ) {}

    public function hargaAkhir(): float
    {
        return $this->harga;
    }

    public function getNama(): string
    {
        return $this->nama;
    }
}

class ProdukDiskon extends Produk
{
    public function __construct(string $nama, float $harga, private float $diskon)
    {
        parent::__construct($nama, $harga);
        // MODIFIKASI 2: validasi nilai diskon
        if ($this->diskon < 0 || $this->diskon > 100) {
            throw new InvalidArgumentException('Diskon harus antara 0 dan 100.');
        }
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 - $this->diskon / 100);
    }
}

// MODIFIKASI 1: class baru untuk produk dengan pajak (PPN)
class ProdukPPN extends Produk
{
    public function __construct(string $nama, float $harga, private float $pajakPersen = 11)
    {
        parent::__construct($nama, $harga);
    }

    public function hargaAkhir(): float
    {
        return $this->harga * (1 + $this->pajakPersen / 100);
    }
}

$daftar = [
    new Produk('Keyboard', 250000),
    new ProdukDiskon('Mouse', 150000, 10),
    new ProdukPPN('Monitor', 1200000), // produk baru dengan PPN 11%
];

$total = 0;
foreach ($daftar as $produk) {
    $harga = $produk->hargaAkhir();
    $total += $harga;
    echo $produk->getNama() . ' Rp ' . number_format($harga, 0, ',', '.') . "<br>";
}

// MODIFIKASI 2 (lanjutan): total keseluruhan
echo '<hr>Total: Rp ' . number_format($total, 0, ',', '.');