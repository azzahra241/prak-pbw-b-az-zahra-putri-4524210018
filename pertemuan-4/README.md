## 📌 Tugas 4 — Pertemuan 4 (Database `akademik1`)

Nama: Az-Zahra Putri

NPM: 4524210018

Mata Kuliah: Prak. Pemrograman Berbasis Web

--- 
### 1. Menjalankan Contoh Pertemuan 4
File `akademik1.sql` (berisi tabel `dosen`, `mahasiswa`, `mata_kuliah`, dan `krs` dengan relasi foreign key antar tabel) telah diimpor ke phpMyAdmin/MySQL melalui XAMPP.
 
### 2. Modifikasi yang Dilakukan
1. **Field baru** — menambahkan kolom `no_hp` pada tabel `dosen`.
2. **Validasi** — menambahkan `CHECK` constraint agar IPK mahasiswa selalu bernilai 0.00–4.00.
3. **Kondisi baru** — menambahkan kolom `status_krs` (ENUM: `aktif`, `batal`) pada tabel `krs`.
4. **Query baru (INSERT)** — menambahkan data dosen, mata kuliah, dan KRS baru yang saling berelasi.
5. **Query baru (SELECT + JOIN multi-tabel)** — menampilkan mahasiswa, mata kuliah yang diambil, dosen pengampu, dan nilai, khusus untuk KRS yang masih aktif.

### 3. Penjelasan 5 Bagian Kode Terpenting
| No | Bagian Kode | Penjelasan |
|----|-------------|------------|
| 1 | `FOREIGN KEY (nim) REFERENCES mahasiswa(nim) ON DELETE CASCADE ON UPDATE CASCADE` | Menjaga integritas data antar tabel: jika data mahasiswa dihapus/diubah NIM-nya, baris KRS terkait otomatis ikut terhapus/diperbarui. |
| 2 | `CONSTRAINT chk_ipk CHECK (ipk BETWEEN 0.00 AND 4.00)` | Validasi di level database agar nilai IPK yang tersimpan selalu masuk akal, tidak bergantung validasi di aplikasi saja. |
| 3 | `ADD UNIQUE KEY uq_krs (nim, kode_mk, semester, tahun_ajaran)` | Unique key gabungan (composite) mencegah satu mahasiswa mengambil mata kuliah yang sama dua kali pada semester & tahun ajaran yang sama. |
| 4 | `JOIN mahasiswa ... JOIN mata_kuliah ... JOIN dosen ...` | Menggabungkan 4 tabel sekaligus untuk menampilkan informasi lengkap (siapa, mata kuliah apa, dosen siapa, nilai berapa) dari satu baris KRS. |
| 5 | `id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT` pada `krs` | Kolom ID otomatis bertambah sebagai primary key; tetap bisa diisi manual saat insert data awal (seperti di `Tugas4.sql`) tanpa mengganggu urutan auto-increment berikutnya. |
 
### 4. Screenshot Sebelum & Sesudah Modifikasi
#### Modifikasi 1 : Menambahkan kolom no_hp pada tabel dosen
**Sebelum:**
![Screenshot Sebelum](screenshot/ss-akademik1-1.png)
 
**Sesudah:**
![Screenshot Sesudah](screenshot/ss-akademik1-2.png)
![Screenshot Sesudah](screenshot/ss-akademik1-3.png)

#### Modifikasi 2 : Menambahkan CHECK constraint agar IPK mahasiswa selalu bernilai 0.00–4.00
**Sebelum:**
![Screenshot Sebelum](screenshot/ss-akademik1-4.png)
 
**Sesudah:**
![Screenshot Sesudah](screenshot/ss-akademik1-5.png)
![Screenshot Sesudah](screenshot/ss-akademik1-6.png)

#### Modifikasi 3 : Menambahkan kolom status_krs (ENUM: aktif, batal) pada tabel krs
**Sebelum:**
![Screenshot Sebelum](screenshot/ss-akademik1-7.png)
 
**Sesudah:**
![Screenshot Sesudah](screenshot/ss-akademik1-8.png)
![Screenshot Sesudah](screenshot/ss-akademik1-9.png)

#### Modifikasi 4 : Menambahkan data dosen, mata kuliah, dan KRS baru yang saling berelasi
**Sebelum:**
![Screenshot Sebelum](screenshot/ss-akademik1-3.png)
![Screenshot Sebelum](screenshot/ss-akademik1-12.png)
![Screenshot Sebelum](screenshot/ss-akademik1-15.png)
 
**Sesudah:**
![Screenshot Sesudah](screenshot/ss-akademik1-10.png)
![Screenshot Sesudah](screenshot/ss-akademik1-11.png)
![Screenshot Sesudah](screenshot/ss-akademik1-13.png)
![Screenshot Sesudah](screenshot/ss-akademik1-14.png)
![Screenshot Sesudah](screenshot/ss-akademik1-16.png)
![Screenshot Sesudah](screenshot/ss-akademik1-17.png)

#### Modifikasi 5 : Menampilkan mahasiswa, mata kuliah yang diambil, dosen pengampu, dan nilai, khusus untuk KRS yang masih aktif
**Sebelum:**
![Screenshot Sebelum](screenshot/ss-akademik1-18.png)
 
**Sesudah:**
![Screenshot Sesudah](screenshot/ss-akademik1-19.png)
![Screenshot Sesudah](screenshot/ss-akademik1-20.png)
 
### 5. Error yang Pernah Muncul
- **Error:**
```
  ERROR 1005 (HY000): Can't create table `akademik1`.`krs` (errno: 150 "Foreign key constraint is incorrectly formed")
```
  (muncul juga sebagai `ERROR 1267: Illegal mix of collations` saat menjalankan query JOIN)
- **Penyebab:** Pada `akademik1.sql`, tabel `dosen`, `krs`, dan `mata_kuliah` didefinisikan secara eksplisit dengan `COLLATE=utf8mb4_unicode_ci`, tetapi tabel `mahasiswa` tidak diberi `ENGINE`/`CHARSET`/`COLLATE` sama sekali — sehingga ia mengikuti collation default database. Jika database dibuat tanpa menentukan collation yang sama (misalnya memakai default `utf8mb4_general_ci`), kolom `nim` di tabel `mahasiswa` dan `krs` punya collation berbeda, sehingga MySQL menolak membuat foreign key di antara keduanya.
- **Perbaikan:** Membuat database `akademik1` secara eksplisit dengan collation yang sama sebelum mengimpor file SQL:
```sql
  CREATE DATABASE akademik1 DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
```
  Setelah itu, import `akademik1.sql` berjalan tanpa error karena tabel `mahasiswa` ikut mengikuti collation default database yang sudah disamakan dengan tabel lainnya. (Alternatif lain: jalankan `ALTER TABLE mahasiswa CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;` setelah import jika database sudah terlanjur dibuat dengan collation berbeda.)