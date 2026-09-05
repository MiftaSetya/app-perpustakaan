## Nama Aplikasi

Sistem Perpustakaan Digital Kampus

## Tujuan

Memudahkan mahasiswa dan dosen mengakses koleksi e-book serta karya ilmiah kapan saja, mengotomatiskan pengelolaan peminjaman, dan mendokumentasikan aset riset kampus secara aman dalam satu platform digital.

## Cara Menjalankan Project

Berikut adalah langkah-langkah untuk menjalankan project ini:

### Prasyarat System
- PHP (>= 8.3)
- Composer
- Database Server (PostgreSQL / MySQL)

---

### Langkah-Langkah Instalasi & Pengoperasian

#### 1. Instal Dependensi PHP
Jalankan perintah berikut di terminal untuk menginstal pustaka yang dibutuhkan:
```bash
composer install
```

#### 2. Konfigurasi Environment File
Salin berkas `.env.example` menjadi `.env`, lalu buat kunci aplikasi baru:
```bash
cp .env.example .env
php artisan key:generate
```
> **Catatan:** Sesuaikan konfigurasi database Anda pada berkas `.env` (`DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

#### 3. Jalankan Migrasi & Seeder Database
Pastikan database server Anda sudah berjalan, lalu jalankan migrasi tabel:
```bash
php artisan migrate
```
Jika ada data awal/dummy (seperti akun admin atau data buku):
```bash
php artisan db:seed
```

#### 4. Jalankan Server Development
Jalankan perintah ini untuk memulai server development:
```bash
composer run dev
```

Aplikasi dapat diakses melalui website pada alamat:
`http://127.0.0.1:8000` atau `http://localhost:8000`

<!--
Model bertugas mengelola logika data dan interaksi langsung dengan database (seperti query dan struktur tabel). 
View fokus pada tampilan antarmuka (UI) yang menampilkan informasi visual kepada pengguna. 
Controller bertindak sebagai perantara yang menerima permintaan pengguna, memproses logika dengan memanggil Model, lalu mengembalikan hasilnya ke View.
-->