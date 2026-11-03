<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $books = [
            [
                'judul' => 'Clean Code',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2008,
                'isbn' => '9780132350884',
                'stok' => 5,
                'category' => 'Teknologi Informasi',
            ],
            [
                'judul' => 'Laskar Pelangi',
                'penulis' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => 2005,
                'isbn' => '9789793062792',
                'stok' => 3,
                'category' => 'Sastra',
            ],
            [
                'judul' => 'Pemrograman Web dengan Laravel',
                'penulis' => 'Budi Raharjo',
                'penerbit' => 'Informatika Bandung',
                'tahun_terbit' => 2023,
                'isbn' => '9786236799123',
                'stok' => 4,
                'category' => 'Pendidikan',
            ],
        ];

        foreach ($books as $book) {
            $category = Category::where('nama_kategori', $book['category'])->firstOrFail();

            Book::updateOrCreate(
                ['isbn' => $book['isbn']],
                [
                    'judul' => $book['judul'],
                    'penulis' => $book['penulis'],
                    'penerbit' => $book['penerbit'],
                    'tahun_terbit' => $book['tahun_terbit'],
                    'stok' => $book['stok'],
                    'category_id' => $category->id,
                ]
            );
        }
    }
}
