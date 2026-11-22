<!DOCTYPE html>
<html>
    <head>
        <title>Tambah Mahasiswa</title>
    </head>
    <body>
        <h2>Tambah Mahasiswa</h2>
        <form action="/mahasiswa/simpan" method="post">
            NIM:
            <input type="text" name="nim" id="nim" required><br><br>
            Nama:
            <input type="text" name="nama" id="nama" required><br><br>
            Prodi:
            <input type="text" name="prodi" id="prodi" required><br><br>
            IPK:
            <input type="number" name="ipk" step="0.01" required><br><br>

            <button type="submit">Simpan</button>
        </form>
    </body>
</html>