# Sistem Perpustakaan Digital Kampus

Aplikasi perpustakaan berbasis Laravel: pengelolaan buku, kategori, anggota, dan peminjaman, dengan pemisahan dua service — aplikasi web (UI) dan API internal.

## Tujuan

Memudahkan mahasiswa dan dosen mengakses koleksi e-book serta karya ilmiah kapan saja, mengotomatiskan pengelolaan peminjaman, dan mendokumentasikan aset riset kampus secara aman dalam satu platform digital.

## Arsitektur: Dua Server

Aplikasi ini berjalan sebagai **dua service terpisah** yang berkomunikasi lewat HTTP:

| Server | Port | Peran |
|---|---|---|
| Aplikasi web | `8000` | UI (login, dashboard, CRUD, laporan) |
| API internal | `8011` | Sumber data JSON untuk Dashboard (`/api/stats`) dan Laporan (`/api/loans`) |

Dashboard dan halaman Laporan **tidak** melakukan query database langsung — keduanya memanggil API di port 8011 sesuai `INTERNAL_API_URL`. Karena itu **kedua server wajib berjalan bersamaan**.

## Prasyarat

- PHP >= 8.3
- Composer
- MySQL

## Instalasi

### 1. Clone repository & install dependency

```bash
git clone <url-repository> app-perpustakaan
cd app-perpustakaan
composer install
```

### 2. Setup environment

Salin `.env.example` menjadi `.env`, lalu generate app key:

```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan konfigurasi berikut di `.env`:

```env
APP_URL=http://localhost:8000

# URL API internal — WAJIB, dipakai Dashboard & Laporan
INTERNAL_API_URL=http://127.0.0.1:8011

# Database (contoh MySQL)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

> Catatan: `.env.example` bawaan memakai `DB_CONNECTION=sqlite`. Ubah ke MySQL

### 3. Migrasi & seed database

```bash
php artisan migrate --seed
```

Seeder mengisi data awal: 3 user (1 admin, 2 petugas), 3 kategori, 3 buku, 3 anggota, dan 3 peminjaman.

### 4. Jalankan dua server

Buka **dua terminal** di root project:

**Terminal 1** — aplikasi web:

```bash
php artisan serve --port=8000
```

**Terminal 2** — API internal:

```bash
php artisan serve --port=8011
```

Aplikasi web dapat diakses di `http://localhost:8000`.

> **Penting:** jika server di port 8011 tidak berjalan, Dashboard akan menampilkan
> angka 0 dan halaman Laporan akan kosong (keduanya gagal menghubungi API internal).

## Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | `admin@pens.ac.id` | `password` |
| Petugas | `petugas1@pens.ac.id` | `password` |
| Petugas | `petugas2@pens.ac.id` | `password` |

## Dokumentasi Terkait

- [`API.md`](API.md) — dokumentasi lengkap endpoint API beserta contoh request/response.
- [`DEMO.md`](DEMO.md) — skenario demo langkah demi langkah.
