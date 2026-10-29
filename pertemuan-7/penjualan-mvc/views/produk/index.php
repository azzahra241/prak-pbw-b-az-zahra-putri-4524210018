<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk - Penjualan MVC</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f9f9f9;">
    
    <div style="max-width: 900px; margin: 30px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        
        <h2 style="margin-top: 0; margin-bottom: 20px; color: #333;">Data Produk Penjualan</h2>
        
        <a href="views/produk/create.php" style="text-decoration:none; background:#007bff; color:white; padding:8px 16px; border-radius:4px; display:inline-block; margin-bottom:15px; font-weight: bold;">+ Tambah Produk</a>
        
        <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; text-align: left;">
            <tr style="background: #f2f2f2; color: #333;">
                <th style="border: 1px solid #ddd; padding: 10px;">ID</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Nama Produk</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Harga</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Stok</th>
                <th style="border: 1px solid #ddd; padding: 10px; text-align: center;">Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($produk)) : ?>
            <tr>
                <td style="border: 1px solid #ddd; padding: 10px;"><?= $row['id']; ?></td>
                <td style="border: 1px solid #ddd; padding: 10px;"><?= htmlspecialchars($row['nama_produk']); ?></td>
                <td style="border: 1px solid #ddd; padding: 10px;">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td style="border: 1px solid #ddd; padding: 10px;"><?= $row['stok']; ?></td>
                <td style="border: 1px solid #ddd; padding: 10px; text-align: center;">
                    <a href="views/produk/edit.php?id=<?= $row['id']; ?>" style="color: #007bff; text-decoration: none; font-weight: bold;">Edit</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

    </div>

</body>
</html>