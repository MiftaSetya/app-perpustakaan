# Dokumentasi API Perpustakaan

Semua endpoint mengembalikan `Content-Type: application/json`.

## Daftar Endpoint

| Method | URL | Body (jika ada) | Contoh Response |
|--------|-----|-----------------|-----------------|
| GET | `/api/books` | – | `200` → `{"data":[{"id":1,"judul":"Clean Code",...}],"links":{...},"meta":{...}}` |
| GET | `/api/books/{id}` | – | `200` → `{"data":{"id":1,"judul":"Clean Code",...}}` |
| POST | `/api/books` | `judul`, `penulis`, `penerbit`, `tahun_terbit`, `isbn`, `stok`, `category_id` | `201` → `{"data":{"id":6,"judul":"Buku Uji Coba",...}}` |
| PUT | `/api/books/{id}` | `judul`, `penulis`, `penerbit`, `tahun_terbit`, `isbn`, `stok`, `category_id` | `200` → `{"data":{"id":1,"judul":"Clean Code",...}}` |
| DELETE | `/api/books/{id}` | – | `200` → `{"message":"Buku berhasil dihapus."}` |
| GET | `/api/members` | – | `200` → `{"data":[{"id":1,"nama":"Siti Nurhaliza",...}],"links":{...},"meta":{...}}` |
| GET | `/api/members/{id}` | – | `200` → `{"data":{"id":1,"nama":"Siti Nurhaliza",...}}` |
| GET | `/api/loans` | – | `200` → `{"data":[{"id":1,"member":{...},"books":[...]}],"links":{...},"meta":{...}}` |
| POST | `/api/loans` | `member_id`, `user_id`, `tanggal_pinjam`, `tanggal_kembali`, `book_ids[]` | `201` → `{"data":{"id":4,"member":{...},"books":[...]}}` |
| PUT | `/api/loans/{id}/kembalikan` | – | `200` → `{"data":{"id":4,"status":"dikembalikan",...}}` |
| GET | `/api/stats` | – | `200` → `{"total_buku":3,"total_anggota":3,"peminjaman_aktif":1}` |

---

## 1. GET /api/books

Mengambil daftar buku (paginate 10 per halaman). Mendukung filter `judul` dan `category_id` via query string.

**Body:** –

**Response `200 OK`:**

```json
{
  "data": [
    {
      "id": 1,
      "judul": "Clean Code",
      "penulis": "Robert C. Martin",
      "penerbit": "Prentice Hall",
      "tahun_terbit": "2008",
      "isbn": "9780132350884",
      "stok": 5,
      "sampul": null,
      "category": {
        "id": 1,
        "nama_kategori": "Teknologi Informasi"
      },
      "created_at": "2026-11-03T14:10:38.000000Z",
      "updated_at": "2026-11-03T14:24:12.000000Z"
    },
    {
      "id": 2,
      "judul": "Laskar Pelangi",
      "penulis": "Andrea Hirata",
      "penerbit": "Bentang Pustaka",
      "tahun_terbit": "2005",
      "isbn": "9789793062792",
      "stok": 3,
      "sampul": null,
      "category": {
        "id": 2,
        "nama_kategori": "Sastra"
      },
      "created_at": "2026-11-03T14:10:38.000000Z",
      "updated_at": "2026-11-03T14:10:38.000000Z"
    },
    {
      "id": 3,
      "judul": "Pemrograman Web dengan Laravel",
      "penulis": "Budi Raharjo",
      "penerbit": "Informatika Bandung",
      "tahun_terbit": "2023",
      "isbn": "9786236799123",
      "stok": 4,
      "sampul": null,
      "category": {
        "id": 3,
        "nama_kategori": "Pendidikan"
      },
      "created_at": "2026-11-03T14:10:38.000000Z",
      "updated_at": "2026-11-03T14:10:38.000000Z"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/books?page=1",
    "last": "http://localhost:8000/api/books?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "page": null,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/books?page=1",
        "label": "1",
        "page": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "page": null,
        "active": false
      }
    ],
    "path": "http://localhost:8000/api/books",
    "per_page": 10,
    "to": 3,
    "total": 3
  }
}
```

---

## 2. GET /api/books/{id}

Mengambil satu buku berdasarkan ID.

**Body:** –

**Response `200 OK`:**

```json
{
  "data": {
    "id": 1,
    "judul": "Clean Code",
    "penulis": "Robert C. Martin",
    "penerbit": "Prentice Hall",
    "tahun_terbit": "2008",
    "isbn": "9780132350884",
    "stok": 5,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Teknologi Informasi"
    },
    "created_at": "2026-11-03T14:10:38.000000Z",
    "updated_at": "2026-11-03T14:24:12.000000Z"
  }
}
```

**Response `404 Not Found`** (ID tidak ada):

```json
{
  "message": "No query results for model [App\\Models\\Book] 999"
}
```

---

## 3. POST /api/books

Menambahkan buku baru.

**Body (JSON):**

```json
{
  "judul": "Buku Uji Coba",
  "penulis": "Penulis Uji",
  "penerbit": "Penerbit Uji",
  "tahun_terbit": 2024,
  "isbn": null,
  "stok": 2,
  "category_id": 1
}
```

**Response `201 Created`:**

```json
{
  "data": {
    "id": 6,
    "judul": "Buku Uji Coba",
    "penulis": "Penulis Uji",
    "penerbit": "Penerbit Uji",
    "tahun_terbit": 2024,
    "isbn": null,
    "stok": 2,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Teknologi Informasi"
    },
    "created_at": "2026-11-03T14:23:36.000000Z",
    "updated_at": "2026-11-03T14:23:36.000000Z"
  }
}
```

**Response `422 Unprocessable Content`** (data tidak valid):

```json
{
  "message": "Judul buku wajib diisi. (and 5 more errors)",
  "errors": {
    "judul": ["Judul buku wajib diisi."],
    "penulis": ["Nama penulis wajib diisi."],
    "penerbit": ["Nama penerbit wajib diisi."],
    "tahun_terbit": ["Tahun terbit tidak valid."],
    "stok": ["Stok tidak boleh kurang dari 0."],
    "category_id": ["Kategori yang dipilih tidak valid."]
  }
}
```

---

## 4. PUT /api/books/{id}

Memperbarui data buku.

**Body (JSON):**

```json
{
  "judul": "Clean Code",
  "penulis": "Robert C. Martin",
  "penerbit": "Prentice Hall",
  "tahun_terbit": 2008,
  "isbn": "9780132350884",
  "stok": 5,
  "category_id": 1
}
```

**Response `200 OK`:**

```json
{
  "data": {
    "id": 1,
    "judul": "Clean Code",
    "penulis": "Robert C. Martin",
    "penerbit": "Prentice Hall",
    "tahun_terbit": 2008,
    "isbn": "9780132350884",
    "stok": 5,
    "sampul": null,
    "category": {
      "id": 1,
      "nama_kategori": "Teknologi Informasi"
    },
    "created_at": "2026-11-03T14:10:38.000000Z",
    "updated_at": "2026-11-03T14:24:12.000000Z"
  }
}
```

**Response `404 Not Found`** (ID tidak ada):

```json
{
  "message": "No query results for model [App\\Models\\Book] 99"
}
```

**Response `422 Unprocessable Content`** (data tidak valid): sama seperti `POST /api/books`.

---

## 5. DELETE /api/books/{id}

Menghapus buku.

**Body:** –

**Response `200 OK`:**

```json
{
  "message": "Buku berhasil dihapus."
}
```

**Response `404 Not Found`** (ID tidak ada):

```json
{
  "message": "No query results for model [App\\Models\\Book] 99"
}
```

---

## 6. GET /api/members

Mengambil daftar anggota (paginate 10 per halaman).

**Body:** –

**Response `200 OK`:**

```json
{
  "data": [
    {
      "id": 1,
      "nama": "Siti Nurhaliza",
      "nim": "2111160001",
      "email": "siti.nurhaliza@student.pens.ac.id",
      "nomor_telepon": "081234567801",
      "alamat": "Jl. Raya ITS No. 1, Surabaya",
      "status": "aktif",
      "created_at": "2026-11-03T14:10:38.000000Z",
      "updated_at": "2026-11-03T14:10:38.000000Z"
    },
    {
      "id": 2,
      "nama": "Budi Santoso",
      "nim": "2111160002",
      "email": "budi.santoso@student.pens.ac.id",
      "nomor_telepon": "081234567802",
      "alamat": "Jl. Ketintang No. 25, Surabaya",
      "status": "aktif",
      "created_at": "2026-11-03T14:10:38.000000Z",
      "updated_at": "2026-11-03T14:10:38.000000Z"
    },
    {
      "id": 3,
      "nama": "Dewi Lestari",
      "nim": "2111160003",
      "email": "dewi.lestari@student.pens.ac.id",
      "nomor_telepon": "081234567803",
      "alamat": "Jl. Darmo No. 10, Surabaya",
      "status": "nonaktif",
      "created_at": "2026-11-03T14:10:38.000000Z",
      "updated_at": "2026-11-03T14:10:38.000000Z"
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/members?page=1",
    "last": "http://localhost:8000/api/members?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "page": null,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/members?page=1",
        "label": "1",
        "page": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "page": null,
        "active": false
      }
    ],
    "path": "http://localhost:8000/api/members",
    "per_page": 10,
    "to": 3,
    "total": 3
  }
}
```

---

## 7. GET /api/members/{id}

Mengambil satu anggota berdasarkan ID.

**Body:** –

**Response `200 OK`:**

```json
{
  "data": {
    "id": 1,
    "nama": "Siti Nurhaliza",
    "nim": "2111160001",
    "email": "siti.nurhaliza@student.pens.ac.id",
    "nomor_telepon": "081234567801",
    "alamat": "Jl. Raya ITS No. 1, Surabaya",
    "status": "aktif",
    "created_at": "2026-11-03T14:10:38.000000Z",
    "updated_at": "2026-11-03T14:10:38.000000Z"
  }
}
```

**Response `404 Not Found`** (ID tidak ada):

```json
{
  "message": "No query results for model [App\\Models\\Member] 999"
}
```

---

## 8. GET /api/loans

Mengambil daftar peminjaman (paginate 10 per halaman), termasuk relasi anggota, petugas, dan buku.

**Body:** –

**Response `200 OK`:**

```json
{
  "data": [
    {
      "id": 1,
      "member": {
        "id": 1,
        "nama": "Siti Nurhaliza"
      },
      "petugas": {
        "id": 2,
        "name": "Petugas Satu"
      },
      "tanggal_pinjam": "2026-10-31",
      "tanggal_kembali": "2026-11-07",
      "tanggal_dikembalikan": null,
      "status": "dipinjam",
      "books": [
        {
          "id": 1,
          "judul": "Clean Code"
        }
      ]
    },
    {
      "id": 2,
      "member": {
        "id": 2,
        "nama": "Budi Santoso"
      },
      "petugas": {
        "id": 2,
        "name": "Petugas Satu"
      },
      "tanggal_pinjam": "2026-10-20",
      "tanggal_kembali": "2026-10-27",
      "tanggal_dikembalikan": "2026-10-27",
      "status": "dikembalikan",
      "books": [
        {
          "id": 2,
          "judul": "Laskar Pelangi"
        }
      ]
    },
    {
      "id": 3,
      "member": {
        "id": 3,
        "nama": "Dewi Lestari"
      },
      "petugas": {
        "id": 2,
        "name": "Petugas Satu"
      },
      "tanggal_pinjam": "2026-10-14",
      "tanggal_kembali": "2026-10-28",
      "tanggal_dikembalikan": null,
      "status": "terlambat",
      "books": [
        {
          "id": 3,
          "judul": "Pemrograman Web dengan Laravel"
        }
      ]
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/loans?page=1",
    "last": "http://localhost:8000/api/loans?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "page": null,
        "active": false
      },
      {
        "url": "http://localhost:8000/api/loans?page=1",
        "label": "1",
        "page": 1,
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "page": null,
        "active": false
      }
    ],
    "path": "http://localhost:8000/api/loans",
    "per_page": 10,
    "to": 3,
    "total": 3
  }
}
```

---

## 9. POST /api/loans

Membuat peminjaman baru beserta item bukunya.

**Body (JSON):**

```json
{
  "member_id": 1,
  "user_id": 2,
  "tanggal_pinjam": "2026-11-01",
  "tanggal_kembali": "2026-11-08",
  "book_ids": [1, 3]
}
```

**Response `201 Created`:**

```json
{
  "data": {
    "id": 4,
    "member": {
      "id": 1,
      "nama": "Siti Nurhaliza"
    },
    "petugas": {
      "id": 2,
      "name": "Petugas Satu"
    },
    "tanggal_pinjam": "2026-11-01",
    "tanggal_kembali": "2026-11-08",
    "tanggal_dikembalikan": null,
    "status": "dipinjam",
    "books": [
      {
        "id": 1,
        "judul": "Clean Code"
      },
      {
        "id": 3,
        "judul": "Pemrograman Web dengan Laravel"
      }
    ]
  }
}
```

**Response `422 Unprocessable Content`** (`member_id` tidak ada):

```json
{
  "message": "The selected member id is invalid.",
  "errors": {
    "member_id": ["The selected member id is invalid."]
  }
}
```

---

## 10. PUT /api/loans/{id}/kembalikan

Menandai peminjaman sebagai sudah dikembalikan.

**Body:** –

**Response `200 OK`:**

```json
{
  "data": {
    "id": 4,
    "member": {
      "id": 1,
      "nama": "Siti Nurhaliza"
    },
    "petugas": {
      "id": 2,
      "name": "Petugas Satu"
    },
    "tanggal_pinjam": "2026-11-01",
    "tanggal_kembali": "2026-11-08",
    "tanggal_dikembalikan": "2026-11-03",
    "status": "dikembalikan",
    "books": [
      {
        "id": 1,
        "judul": "Clean Code"
      },
      {
        "id": 3,
        "judul": "Pemrograman Web dengan Laravel"
      }
    ]
  }
}
```

**Response `404 Not Found`** (ID tidak ada):

```json
{
  "message": "No query results for model [App\\Models\\Loan] 99"
}
```

---

## 11. GET /api/stats

Mengambil ringkasan statistik perpustakaan.

**Body:** –

**Response `200 OK`:**

```json
{
  "total_buku": 3,
  "total_anggota": 3,
  "peminjaman_aktif": 1
}
```
