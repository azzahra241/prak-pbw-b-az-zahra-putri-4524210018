<?php

// MODIFIKASI 1: menambahkan properti/field baru "prodi" pada class Mahasiswa
// MODIFIKASI 2: menambahkan kondisi baru getPredikat() + validasi nama tidak boleh kosong

interface Identitas
{
    public function ringkasan(): string;
}

class Mahasiswa implements Identitas
{
    private string $nim;
    private string $nama;
    private string $prodi; // MODIFIKASI 1: properti baru
    protected float $ipk;

    public function __construct(string $nim, string $nama, string $prodi, float $ipk)
    {
        // MODIFIKASI 2: validasi baru, nama tidak boleh kosong
        if (trim($nama) === '') {
            throw new InvalidArgumentException('Nama tidak boleh kosong.');
        }

        $this->nim = $nim;
        $this->nama = $nama;
        $this->prodi = $prodi;
        $this->setIpk($ipk);
    }

    public function setIpk(float $ipk): void
    {
        if ($ipk < 0 || $ipk > 4) {
            throw new InvalidArgumentException('IPK harus 0 sampai 4.');
        }
        $this->ipk = $ipk;
    }

    public function getIpk(): float
    {
        return $this->ipk;
    }

    // MODIFIKASI 2 (lanjutan): kondisi baru untuk menentukan predikat kelulusan
    public function getPredikat(): string
    {
        if ($this->ipk >= 3.50) return 'Sangat Memuaskan';
        if ($this->ipk >= 3.00) return 'Memuaskan';
        return 'Perlu Peningkatan';
    }

    public function ringkasan(): string
    {
        return $this->nim . ' - ' . $this->nama . ' (' . $this->prodi . ')'
            . ' - IPK: ' . $this->ipk . ' - Predikat: ' . $this->getPredikat();
    }
}

$mhs = new Mahasiswa('2026001', 'Az-Zahra Putri', 'Teknik Informatika', 3.83);
echo $mhs->ringkasan();