<?php
include "koneksi.php";

$cari = $_GET['cari'] ?? '';
if ($cari != '') {
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim LIKE '%$cari%' OR nama LIKE '%$cari%' OR prodi LIKE '%$cari%'");
} else {
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Data Mahasiswa</title>
</head>
<body class="bg-gray-50 p-6 font-sans text-gray-800">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Data Mahasiswa</h2>
        
        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-6">
            <a href="create.php" class="inline-block bg-blue-600 text-white font-semibold px-4 py-2 rounded text-center">
                + Tambah Mahasiswa
            </a>
            
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="cari" placeholder="Cari NIM, nama, prodi..." value="<?= htmlspecialchars($cari) ?>" class="p-2 border border-gray-300 rounded text-sm w-full sm:w-64">
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded text-sm font-semibold shrink-0">Cari</button>
                <?php if($cari != ''): ?>
                    <a href="index.php" class="bg-gray-300 text-gray-800 px-3 py-2 rounded text-sm shrink-0 flex items-center">Reset</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-200 text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-200 p-3 font-semibold">NIM</th>
                        <th class="border border-gray-200 p-3 font-semibold">Nama</th>
                        <th class="border border-gray-200 p-3 font-semibold">Email</th>
                        <th class="border border-gray-200 p-3 font-semibold">Prodi</th>
                        <th class="border border-gray-200 p-3 font-semibold">Angkatan</th>
                        <th class="border border-gray-200 p-3 font-semibold">IPK & Predikat</th>
                        <th class="border border-gray-200 p-3 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                        <?php while ($data = mysqli_fetch_assoc($query)) { 
                            $ipk = $data['ipk'];
                            if ($ipk >= 3.50) {
                                $predikat = "<span class='text-green-600 font-semibold text-xs'>Cumlaude 🎓</span>";
                            } elseif ($ipk >= 3.00) {
                                $predikat = "<span class='text-blue-600 font-semibold text-xs'>Sangat Memuaskan</span>";
                            } else {
                                $predikat = "<span class='text-gray-500 text-xs'>Baik</span>";
                            }
                        ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['nim']); ?></td>
                            <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['nama']); ?></td>
                            <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['email']); ?></td>
                            <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['prodi']); ?></td>
                            <td class="border border-gray-200 p-3"><?= htmlspecialchars($data['angkatan']); ?></td>
                            <td class="border border-gray-200 p-3">
                                <span class="font-bold"><?= htmlspecialchars($data['ipk']); ?></span><br>
                                <?= $predikat; ?>
                            </td>
                            <td class="border border-gray-200 p-3 text-center">
                                <a href="edit.php?nim=<?= $data['nim']; ?>" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Edit</a>
                                <span class="mx-1 text-gray-300">|</span>
                                <a href="delete.php?nim=<?= $data['nim']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="text-red-600 hover:text-red-800 hover:underline font-medium">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="7" class="border border-gray-200 p-4 text-center text-gray-500">Data mahasiswa tidak ditemukan.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>