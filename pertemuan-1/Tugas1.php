<?php

$hasil = null;
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';

    switch ($operator) {
        case '+':
            $hasil = $a + $b;
            break;
        case '-':
            $hasil = $a - $b;
            break;
        case '*':
            $hasil = $a * $b;
            break;
        case '/':
            if ($b == 0) {
                $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
            } else {
                $hasil = $a / $b;
            }
            break;
        case '%': 
            if ($b == 0) {
                $pesan = 'Modulus dengan nol tidak diperbolehkan.';
            } else {
                $hasil = fmod($a, $b);
            }
            break;
        default:
            $pesan = 'Operator tidak valid.';
    }
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Kalkulator - Tugas 1</title>
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
            width: 320px;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 16px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #1e4fc4;
        }

        .hasil {
            margin-top: 12px;
            padding: 10px;
            background: #eef4ff;
            border-radius: 6px;
        }

        .error {
            margin-top: 12px;
            padding: 10px;
            background: #fdeaea;
            color: #b91c1c;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Kalkulator Sederhana</h1>
        <form method="post">
            <input type="number" step="any" name="a" placeholder="Angka pertama" required>
            <select name="operator">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
                <option value="%">%</option>
            </select>
            <input type="number" step="any" name="b" placeholder="Angka kedua" required>
            <button type="submit">Hitung</button>
        </form>
        <?php if ($pesan): ?>
            <div class="error"><?= htmlspecialchars($pesan) ?></div>
        <?php elseif ($hasil !== null): ?>
            <div class="hasil">Hasil: <?= htmlspecialchars((string)$hasil) ?></div>
        <?php endif; ?>
    </div>
</body>

</html>