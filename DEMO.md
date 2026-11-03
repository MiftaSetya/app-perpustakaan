# Skenario Demo UAS

Panduan langkah demi langkah mendemokan aplikasi.

## Persiapan Sebelum Demo

1. **Pastikan database sudah terisi data awal**

   ```bash
   php artisan migrate:fresh --seed
   ```

   Perintah ini mengisi 3 user, 3 kategori, 3 buku, 3 anggota, dan 3 peminjaman.

2. **Jalankan dua server** (wajib, di dua terminal terpisah)

   Terminal 1 — server utama (UI web):

   ```bash
   php artisan serve --port=8000
   ```

   Terminal 2 — server API internal (dipakai Dashboard & Laporan):

   ```bash
   php artisan serve --port=8011
   ```

   > Dashboard dan halaman Laporan mengambil data lewat HTTP ke `INTERNAL_API_URL`
   > (`http://127.0.0.1:8011`). Kalau server 8011 tidak jalan, dashboard akan
   > menampilkan angka 0 dan laporan akan kosong.

3. **Buka browser** ke `http://localhost:8000`

## Akun Demo

| Role | Email | Password |
|---|---|---|
| Admin | `admin@pens.ac.id` | `password` |
| Petugas | `petugas1@pens.ac.id` | `password` |

Login sebagai **Admin** untuk demo penuh (menu Kategori hanya muncul untuk admin).

---

## Urutan Langkah Demo

### 1. Login

- Buka `http://localhost:8000` → otomatis diarahkan ke halaman login.
- Isi email `admin@pens.ac.id` dan password `password`.
- Klik **Login**.
- **Yang ditunjukkan:** pesan sukses "Login berhasil, selamat datang Admin Perpustakaan."

### 2. Tampilkan Dashboard

- Setelah login, klik menu **Dashboard** di navbar.
- **Yang ditunjukkan:**
  - Kartu **Total Buku** = 3
  - Kartu **Total Anggota** = 3
  - Kartu **Peminjaman Aktif** = 1
  - Jelaskan: angka ini **bukan** query langsung ke database, tapi hasil HTTP request
    ke `GET http://127.0.0.1:8011/api/stats`. Inilah alasan server kedua harus jalan.

### 3. Tambah Kategori

- Klik menu **Kategori** → tombol **Tambah Kategori**.
- Isi form:
  - Nama Kategori: `Sejarah`
  - Deskripsi: `Buku sejarah nasional dan dunia.`
- Klik **Simpan**.
- **Yang ditunjukkan:** redirect ke daftar kategori + pesan sukses
  "Kategori "Sejarah" berhasil ditambahkan."

### 4. Tambah Buku

- Klik menu **Buku** → tombol **Tambah Buku**.
- Isi form:
  - Judul: `Sejarah Indonesia Modern`
  - Penulis: `M.C. Ricklefs`
  - Penerbit: `Serambi`
  - Tahun Terbit: `2008`
  - ISBN: `9789791116107`
  - Stok: `2`
  - Kategori: pilih **Sejarah** (kategori yang baru dibuat)
- Klik **Simpan**.
- **Yang ditunjukkan:** buku baru muncul di daftar + pesan sukses.

### 5. Tambah Anggota

- Klik menu **Anggota** → tombol **Tambah Anggota**.
- Isi form:
  - Nama: `Rizky Pratama`
  - NIM: `2111160010`
  - Email: `rizky.pratama@student.pens.ac.id`
  - Nomor Telepon: `081234567810`
  - Alamat: `Jl. Sukolilo No. 5, Surabaya`
  - Status: `aktif`
- Klik **Simpan**.
- **Yang ditunjukkan:** anggota baru muncul di daftar + pesan sukses.

### 6. Buat Peminjaman

- Klik menu **Peminjaman** → tombol **Tambah Peminjaman**.
- Isi form:
  - Anggota: pilih **Rizky Pratama**
  - Tanggal Pinjam: hari ini
  - Tanggal Kembali: hari ini + 7 hari
  - Buku: centang **Sejarah Indonesia Modern** (boleh centang lebih dari satu)
- Klik **Simpan**.
- **Yang ditunjukkan:** transaksi baru muncul di daftar peminjaman dengan status
  **Dipinjam** dan petugas terisi otomatis dari user yang sedang login.

### 7. Lihat Daftar Peminjaman Aktif

- Masih di menu **Peminjaman**.
- **Yang ditunjukkan:** tabel berisi seluruh transaksi; tunjukkan baris dengan status
  **Dipinjam** (termasuk transaksi yang baru dibuat). Sebutkan bahwa `peminjaman_aktif`
  di dashboard menghitung status ini.

### 8. Proses Pengembalian

- Pada baris peminjaman yang masih **Dipinjam**, klik tombol **Kembalikan**.
- Konfirmasi dialog yang muncul.
- **Yang ditunjukkan:**
  - Pesan sukses "Buku berhasil dikembalikan."
  - Status baris berubah menjadi **Dikembalikan**
  - Tanggal Dikembalikan terisi tanggal hari ini
  - Kembali ke **Dashboard** → angka **Peminjaman Aktif** berkurang satu

### 9. Tampilkan Laporan

- Klik menu **Laporan**.
- **Yang ditunjukkan:**
  - Tabel laporan peminjaman (ID, Anggota, Petugas, Buku, Tgl Pinjam, Tgl Kembali, Status)
  - Jelaskan: halaman ini mengambil data dari `GET http://127.0.0.1:8011/api/loans`
    — bukan query database langsung. Ini membuktikan aplikasi web dan API berjalan
    sebagai dua service terpisah yang saling berkomunikasi lewat HTTP.
  - Jika data lebih dari 10 baris, tunjukkan navigasi halaman (pagination) di bawah tabel.

### 10. Demo API di Postman

Buka Postman, lalu demokan endpoint berikut satu per satu. Semua response harus
berformat **JSON** (bukan HTML).

| No | Method | URL | Body |
|---|---|---|---|
| 1 | GET | `http://localhost:8011/api/books` | – |
| 2 | GET | `http://localhost:8011/api/books/1` | – |
| 3 | POST | `http://localhost:8011/api/books` | lihat di bawah |
| 4 | PUT | `http://localhost:8011/api/books/1` | lihat di bawah |
| 5 | DELETE | `http://localhost:8011/api/books/{id}` | – |
| 6 | GET | `http://localhost:8011/api/members` | – |
| 7 | GET | `http://localhost:8011/api/loans` | – |
| 8 | POST | `http://localhost:8011/api/loans` | lihat di bawah |
| 9 | PUT | `http://localhost:8011/api/loans/{id}/kembalikan` | – |
| 10 | GET | `http://localhost:8011/api/stats` | – |

**Body POST /api/books** (header `Content-Type: application/json`):

```json
{
  "judul": "Buku Demo Postman",
  "penulis": "Demo",
  "penerbit": "Demo",
  "tahun_terbit": 2024,
  "isbn": "9780000000001",
  "stok": 1,
  "category_id": 1
}
```

**Body PUT /api/books/{id}**:

```json
{
  "judul": "Buku Demo Postman (Edit)",
  "penulis": "Demo",
  "penerbit": "Demo",
  "tahun_terbit": 2024,
  "isbn": "9780000000001",
  "stok": 5,
  "category_id": 1
}
```

**Body POST /api/loans**:

```json
{
  "member_id": 1,
  "user_id": 2,
  "tanggal_pinjam": "2026-11-03",
  "tanggal_kembali": "2026-11-10",
  "book_ids": [1, 2]
}
```

**Skenario gagal yang perlu ditunjukkan** (bukti validasi berjalan):

- `POST /api/books` dengan body kosong `{}` → **422** + objek `errors` per field.
- `GET /api/books/999` (ID tidak ada) → **404**.

Dokumentasi lengkap seluruh endpoint beserta contoh response ada di [`API.md`](API.md).

---

## Ringkasan Poin yang Disampaikan Saat Demo

1. Aplikasi web (port 8000) dan API (port 8011) adalah **dua service terpisah**.
2. Dashboard dan Laporan **mengonsumsi API lewat HTTP**, bukan query database langsung.
3. Semua operasi CRUD berjalan: buku, kategori, anggota, peminjaman, pengembalian.
4. API mengembalikan JSON dengan status code yang benar (200/201/404/422).
5. Validasi input berjalan di sisi web (Form Request) maupun API.
