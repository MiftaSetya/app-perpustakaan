<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Teknologi Informasi',
                'deskripsi' => 'Buku seputar pemrograman, jaringan, dan rekayasa perangkat lunak.',
            ],
            [
                'nama_kategori' => 'Sastra',
                'deskripsi' => 'Kumpulan karya fiksi, novel, dan puisi.',
            ],
            [
                'nama_kategori' => 'Pendidikan',
                'deskripsi' => 'Buku pelajaran dan referensi akademik.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                $category
            );
        }
    }
}
