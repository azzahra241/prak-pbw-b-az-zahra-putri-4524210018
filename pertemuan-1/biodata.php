<?php

// MODIFIKASI 1: menambahkan field baru "email" ke data mahasiswa
// MODIFIKASI 2: menambahkan kondisi baru (warna badge sesuai predikat) + styling CSS

function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

// MODIFIKASI 2: kondisi baru untuk menentukan warna badge predikat
function warnaPredikat(string $predikat): string
{
    return match ($predikat) {
        'Sangat Memuaskan' => '#16a34a', 
        'Memuaskan' => '#2563eb',       
        default => '#dc2626',            
    };
}

$mahasiswa = [
    'nim' => '2026001',
    'nama' => 'Az-Zahra Putri',
    'prodi' => 'Teknik Informatika',
    'semester' => 5,
    'ipk' => 3.83,
    'email' => 'azzahraputri@kampus.ac.id', // MODIFIKASI 1: field baru
];

$predikat = statusKelulusan($mahasiswa['ipk']);
$warna = warnaPredikat($predikat);
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Biodata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            padding-top: 40px;
        }

        .card {
            background: #fff;
            padding: 24px 32px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
            width: 340px;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 16px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0 0 16px;
        }

        li {
            padding: 6px 0;
            border-bottom: 1px solid #eee;
        }

        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            color: #fff;
            font-weight: bold;
            background: <?= $warna ?>;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Biodata Mahasiswa</h1>
        <ul>
            <?php foreach ($mahasiswa as $kunci => $nilai): ?>
                <li><?= ucfirst($kunci) ?>: <?= htmlspecialchars((string)$nilai) ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Predikat: <span class="badge"><?= htmlspecialchars($predikat) ?></span></p>
    </div>
</body>

</html>